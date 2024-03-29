<?php
include ("connect.php");

function random_characters()
{
    $characters = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz";
    $string_length = 4;

    return substr(str_shuffle($characters), 0, $string_length);
}

function download(?array $files, ?string $title)
{
    if (!empty ($files)) {
        $random_characters = random_characters();

        // Avoid at the same time, users download the same name Zip file that make they overide the file -> make the Zip file name unique 
        $zip_name = $title . "_{$random_characters}.zip";

        $zip = new ZipArchive();
        $zip->open("downloads/{$zip_name}", ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }
        $zip->close();

        // Download the zip archive
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$zip_name");
        readfile("downloads/$zip_name");

        // Delete temporary zip file
        unlink("downloads/$zip_name");
    } else {
        echo "No files to download! found for download.";
    }
}

function downloadMultiArticles(?array $articles, ?mysqli $conn, ?string $title)
{
    $random_characters = random_characters();
    $zip_name_all = $title . "_{$random_characters}.zip";

    $zip_all = new ZipArchive();
    $zip_all->open("downloads/{$zip_name_all}", ZipArchive::CREATE);
    $zip_files = [];

    foreach ($articles as $articleId) {
        $sql_article_title = "SELECT magazine.magazineName, faculties.facultyName, title FROM `articles`
            INNER JOIN `users` ON users.userId = articles.authorId 
            INNER JOIN `faculties` ON faculties.facultyId = users.facultyId
            INNER JOIN `magazine` ON magazine.magazineId = articles.magazineId
            WHERE articleId = $articleId";

        $result_article_title = $conn->query($sql_article_title);
        $row = $result_article_title->fetch_assoc();

        $article_title = $row["title"];
        $magazine_name = $row["magazineName"];
        $faculty_name = $row["facultyName"];

        $sql_files_article = "SELECT filePath FROM `files` 
            INNER JOIN `articles` ON articles.articleId = files.articleId 
            WHERE files.articleId = $articleId";

        $result_files_article = $conn->query($sql_files_article);
        if ($result_files_article->num_rows > 0) {
            while ($row = $result_files_article->fetch_assoc()) {
                $docs[] = $row['filePath'];
            }
        }

        if (!empty ($docs)) {
            $random_characters = random_characters();

            $zip_name = $magazine_name . "_" . $faculty_name . "_" . $article_title . "_{$random_characters}.zip";

            $zip_files[] = $zip_name;

            $zip = new ZipArchive();
            $zip->open("downloads/{$zip_name}", ZipArchive::CREATE);
            foreach ($docs as $file) {
                $zip->addFile($file, basename($file));
            }

            $zip->close();

            $zip_all->addFile("downloads/$zip_name", $zip_name);
        } else {
            echo "No files to download!";
        }
        // Reset array docs
        $docs = [];
    }

    $zip_all->close();

    // Download the zip archive
    header("Content-Type: application/zip");
    header("Content-Disposition: attachment; filename=$zip_name_all");
    readfile("downloads/$zip_name_all");

    // Delete temporary zip file
    unlink("downloads/$zip_name_all");
    foreach ($zip_files as $files) {
        unlink("downloads/$files");
    }
}

// Download article public 
if (isset ($_POST["articlePublicId"])) {
    $articleId = htmlentities(strip_tags($_POST["articlePublicId"]));

    $sql_article_title = "SELECT title FROM `articles` WHERE articleId = $articleId AND showStatus = 1";
    $result_article_title = $conn->query($sql_article_title);

    $article_title = "";
    if ($result_article_title->num_rows > 0) {
        $row = $result_article_title->fetch_assoc();
        $article_title = $row["title"];
    } else {
        $article_title = "Docs";
    }

    $sql_article_files = "SELECT filePath FROM `files` 
    INNER JOIN `articles` ON articles.articleId = files.articleId 
    WHERE files.articleId = $articleId
    AND articles.showStatus = 1";

    $result_article_files = $conn->query($sql_article_files);

    if ($result_article_files->num_rows > 0) {
        while ($row = $result_article_files->fetch_assoc()) {
            $docs[] = $row['filePath'];
        }
    }

    download($docs, $article_title);
}

// Download article that user uploaded
if (isset ($_POST["articleUserId"])) {
    session_start();
    $articleId = htmlentities(strip_tags($_POST["articleUserId"]));
    $userId = $_SESSION["userid"];

    $sql_article_title = "SELECT title FROM `articles` WHERE articleId = $articleId AND authorId = $userId";
    $result_article_title = $conn->query($sql_article_title);

    $article_title = "";
    if ($result_article_title->num_rows > 0) {
        $row = $result_article_title->fetch_assoc();
        $article_title = $row["title"];
    } else {
        $article_title = "Docs";
    }

    $sql_user_article = "SELECT filePath FROM `files` 
    INNER JOIN `articles` ON articles.articleId = files.articleId 
    INNER JOIN `users` ON users.userId = articles.authorId
    WHERE files.articleId = $articleId
    AND articles.authorId = $userId";

    $result_user_article = $conn->query($sql_user_article);
    if ($result_user_article->num_rows > 0) {
        while ($row = $result_user_article->fetch_assoc()) {
            $docs[] = $row['filePath'];
        }
    }

    download($docs, $article_title);
}

// Download all articles filtered based on magazines and faculties
if (isset ($_POST['btnDownloadAll'])) {
    $optionMagazine = htmlentities(strip_tags($_POST['optionMagazine']));
    $optionFaculty = htmlentities(strip_tags($_POST['optionFaculty']));

    if ($optionMagazine == 'optionAllMagazine' && $optionFaculty == 'optionAllFaculty') {
        $sql_articles_filtered = "SELECT articles.articleId FROM `articles` 
        INNER JOIN `users` ON users.userId = articles.authorId
        INNER JOIN `faculties` ON faculties.facultyId = users.facultyId
        INNER JOIN `magazine` ON magazine.magazineId = articles.magazineId
        INNER JOIN `files` ON files.articleId = articles.articleId
        WHERE articles.status = 1
        GROUP BY articles.articleId";

        $result_articles_filtered = $conn->query($sql_articles_filtered);
        if ($result_articles_filtered->num_rows > 0) {
            while ($row = $result_articles_filtered->fetch_assoc()) {
                $articles[] = $row["articleId"];
            }
            downloadMultiArticles($articles, $conn, 'All_Articles');
        }

        return;
    }

    if ($optionMagazine == 'optionAllMagazine' && $optionFaculty != 'optionAllFaculty') {
        $sql_articles_filtered = "SELECT faculties.facultyName, articles.articleId FROM `articles` 
        INNER JOIN `users` ON users.userId = articles.authorId
        INNER JOIN `faculties` ON faculties.facultyId = users.facultyId
        INNER JOIN `magazine` ON magazine.magazineId = articles.magazineId
        INNER JOIN `files` ON files.articleId = articles.articleId
        WHERE faculties.facultyId = $optionFaculty
        AND articles.status = 1
        GROUP BY articles.articleId";

        $result_articles_filtered = $conn->query($sql_articles_filtered);
        if ($result_articles_filtered->num_rows > 0) {
            while ($row = $result_articles_filtered->fetch_assoc()) {
                $articles[] = $row["articleId"];
                $facultyName = $row['facultyName'];
            }
            $title = 'All_Magazines_' . $facultyName;
            downloadMultiArticles($articles, $conn, $title);
        } else
            echo 'No files to download!';


        return;
    }

    if ($optionFaculty == 'optionAllFaculty' && $optionMagazine != 'optionAllMagazine') {
        $sql_articles_filtered = "SELECT magazine.magazineName, articles.articleId FROM `articles` 
        INNER JOIN `users` ON users.userId = articles.authorId
        INNER JOIN `faculties` ON faculties.facultyId = users.facultyId
        INNER JOIN `magazine` ON magazine.magazineId = articles.magazineId
        INNER JOIN `files` ON files.articleId = articles.articleId
        WHERE magazine.magazineId = $optionMagazine
        AND articles.status = 1
        GROUP BY articles.articleId";

        $result_articles_filtered = $conn->query($sql_articles_filtered);
        if ($result_articles_filtered->num_rows > 0) {
            while ($row = $result_articles_filtered->fetch_assoc()) {
                $articles[] = $row["articleId"];
                $magazineName = $row["magazineName"];
            }
            $title = $magazineName . "_All_Faculties";
            downloadMultiArticles($articles, $conn, $title);
        } else
            echo 'No files to download!';
        return;
    }



    $sql_articles_filtered = "SELECT faculties.facultyName, magazine.magazineName, articles.articleId FROM `articles` 
    INNER JOIN `users` ON users.userId = articles.authorId
    INNER JOIN `faculties` ON faculties.facultyId = users.facultyId
    INNER JOIN `magazine` ON magazine.magazineId = articles.magazineId
    INNER JOIN `files` ON files.articleId = articles.articleId
    WHERE magazine.magazineId = $optionMagazine 
    AND faculties.facultyId = $optionFaculty
    AND articles.status = 1
    GROUP BY articles.articleId";

    $result_articles_filtered = $conn->query($sql_articles_filtered);
    if ($result_articles_filtered->num_rows > 0) {
        while ($row = $result_articles_filtered->fetch_assoc()) {
            $articles[] = $row["articleId"];
            $facultyName = $row['facultyName'];
            $magazineName = $row["magazineName"];
        }
        $title = $magazineName . "_" . $facultyName;
        downloadMultiArticles($articles, $conn, $title);
    } else
        echo 'No files to download!';
    return;
}


if (isset ($_POST['btnDownload']) && isset ($_POST['articleId'])) {
    $articles = $_POST['articleId'];
    $title = 'Articles';

    downloadMultiArticles($articles, $conn, $title);
}

?>