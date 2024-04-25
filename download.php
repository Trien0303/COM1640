<?php
include("connect.php");

function random_characters()
{
    $characters = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz";
    $string_length = 4;

    return substr(str_shuffle($characters), 0, $string_length);
}



function download(?array $files, ?string $title = null) {
    $title = $title ?? 'download'; 
    
   

        $zip = new ZipArchive();
        $zipName = $title . '.zip';
        
        if ($zip->open($zipName, ZipArchive::CREATE) !== TRUE) {
            exit("Cannot open <$zipName>\n");
        }
        
        foreach ($files as $file) {
            if (file_exists($file)) {
                $zip->addFile($file, basename($file));
            }
        }
        
        $zip->close();
        
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename="' . $zipName . '"');
        header('Content-Length: ' . filesize($zipName));
        readfile($zipName);
        
    
        unlink($zipName);
    
}



function downloadMultiArticles(?array $articles, ?mysqli $conn, ?string $title)
{
    $random_characters = random_characters();
    $zip_name_all = $title . "_{$random_characters}.zip";

    $zip_all = new ZipArchive();
    if ($zip_all->open("downloads/{$zip_name_all}", ZipArchive::CREATE) === TRUE) {
        foreach ($articles as $articleId) {
            // Your existing logic here...
        }

        $zip_all->close();

        // Download the zip archive
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$zip_name_all");
        readfile("downloads/$zip_name_all");

        // Delete temporary zip file
        unlink("downloads/$zip_name_all");
    } else {
        echo "Failed to create ZIP archive for all articles.";
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

if (isset ($_POST['btnDownload']) && isset ($_POST['articleId'])) {
    $articles = $_POST['articleId'];
    $title = 'Articles';

    downloadMultiArticles($articles, $conn, $title);
}

?>