<?php
include_once ("connect.php");
require 'send_mail.php';
session_start();

// Define upload directory
$target_dir_files = "./files/";
$target_dir_image_article = "./images_article/";

function check_image($image_name, $image_type, $image_size, $target_dir)
{
    $allowed_extensions = array("jpg", "png");
    if (!in_array($image_type, $allowed_extensions)) {
        echo "<script>alert('Sorry, only JPG and PNG files are allowed.')</script>";
        return false;
    }

    if ($image_size > 5000000) {
        echo "Sorry, your image " . $image_name . " is too large.";
        return false;
    }

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image_name)) {
        echo "Error uploading image!";
        return false;
    }
    return true;
}

function check_file($file_name, $file_tmp_name, $file_type, $file_size, $target_dir)
{
    $allowed_extensions = array("doc", "docx");
    if (!in_array($file_type, $allowed_extensions)) {
        echo "Sorry, only DOC and DOCX files are allowed.";
        return false;
    }

    

    if ($file_size > 5000000) {
        echo "Sorry, your file " . $file_name . " is too large.";
        return false;
    }

    
    return true;
}

// Check if form is submitted and there are no errors
if (isset ($_POST["Submit"]) && !empty ($_FILES["files"]["name"][0])) {
    $title = htmlentities(strip_tags($_POST["article_title"])); // Sanitize title
    $content = htmlentities(strip_tags($_POST["article_content"])); // Sanitize content
    $authorId = $_SESSION['userid'];
    $magazineId = $_POST["magazineId"];

    $uploadOk = true;

    $file_image_name = basename($_FILES["image"]["name"]);
    $unique_image_name = uniqid('', true) . '.' . pathinfo($file_image_name, PATHINFO_EXTENSION);
    $target_image_file = $target_dir_image_article . $file_image_name;
    $imageFileType = strtolower(pathinfo($target_image_file, PATHINFO_EXTENSION));

    if (!check_image($file_image_name, $imageFileType, $_FILES["image"]["size"], $target_dir_image_article))
        return;

    foreach ($_FILES["files"]["name"] as $key => $value) {
        $file_name = basename($value);
        $target_file = $target_dir_files . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!check_file($file_name, $_FILES["files"]["tmp_name"][$key], $imageFileType, $_FILES["files"]["size"][$key], $target_dir_files)) {
            $uploadOk = false;
            break;
        }
    }

    // Insert article into articles table
    $target_image = "images_article/" . $file_image_name;
    $sql_article = "INSERT INTO articles (title, content, authorId, magazineId, image) VALUES (?, ?, ?, ?, ?)";
    $stmt_article = $conn->prepare($sql_article);
    $stmt_article->bind_param("ssiis", $title, $content, $authorId, $magazineId, $target_image);
    $stmt_article->execute();
    // Get the last inserted article ID
    $article_id = $conn->insert_id;

    $coordinator = [];
    $coordinator_email = '';
    $coordinator_name = '';
    $multi_recipient = false;

    $sql_coordinator = "SELECT * FROM `users` u
	INNER JOIN `roles` r ON u.roleId = r.roleId 
    WHERE r.roleId = 3
    AND u.facultyId = (SELECT facultyId FROM `users` WHERE users.userId = $authorId)";
    $result_coordinator = $conn->query($sql_coordinator);

    if ($result_coordinator->num_rows > 1) {
        $multi_recipient = true;
        while ($row = $result_coordinator->fetch_assoc()) {
            $coordinator[] = $row['email'];
        }
    } elseif ($result_coordinator->num_rows > 0) {
        $row = $result_coordinator->fetch_assoc();
        $coordinator_email = $row['email'];
        $coordinator_name = $row['name'];
    }


    // Insert each files 
    foreach ($_FILES["files"]["name"] as $key => $value) {
        $file_name = basename($value);
        $target_file = $target_dir_files . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $target_file)) {
            $file_path = "files/" . $file_name;
            $sql = "INSERT INTO files (articleId, fileName, filePath) VALUES (?, ?, ?)";
            $stmt_files = $conn->prepare($sql);
            $stmt_files->bind_param("iss", $article_id, $file_name, $file_path);
            $stmt_files->execute();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Commit the transaction if all insertions were successful
    if ($uploadOk) {
        $conn->commit();
        $message = 'Dear teachers, The system notifies teachers that the student has successfully submitted the assignment to the system. Teachers, please give comments and ratings within 14 days. After 14 days, teachers will not be able to comment.';

        sendMail($coordinator_email, $coordinator_name, $message, $multi_recipient, $coordinator);

        $_SESSION['return'] = "The article and file(s) have been uploaded successfully.";
        echo "<script>window.location.href = 'index.php?page=magazineStudent';</script>";
    } else {
        $conn->rollback(); // Rollback if any errors occurred
        echo "An error occurred during upload. Please try again.";
    }

    // Close prepared statements
    $stmt_article->close();
}

// Update user article
if (isset ($_POST["Update"])) {
    $user_id = $_SESSION['userid'];
    $article_id = $_POST['articleId'];
    $title = htmlentities(strip_tags($_POST["article_title"])); // Sanitize title
    $content = htmlentities(strip_tags($_POST["article_content"])); // Sanitize content
    $uploadOk = true;
    // $sql_article_update = "SELECT * FROM articles WHERE articleId = $article_id AND authorId = $user_id";

    if (empty ($_FILES["image"]['name'][0]) && empty ($_FILES["files"]['name'][0])) {
        $sql_article_update = "UPDATE `articles` SET `title` = '$title', `content` = '$content' 
        WHERE articles.articleId = $article_id 
        AND articles.authorId = $user_id";

        if ($conn->query($sql_article_update)) {
            $_SESSION['return'] = "Your article have been updated successfully.";
            echo "<script>window.location.href = 'index.php?page=magazineStudent';</script>";
        }
        return;
    }

    if (!empty ($_FILES['image']['name'][0])) {
        $file_image_name = basename($_FILES["image"]["name"]);
        $unique_image_name = uniqid('', true) . '.' . pathinfo($file_image_name, PATHINFO_EXTENSION);
        $target_image_file = $target_dir_image_article . $file_image_name;
        $imageFileType = strtolower(pathinfo($target_image_file, PATHINFO_EXTENSION));

        if (!check_image($file_image_name, $imageFileType, $_FILES["image"]["size"], $target_dir_image_article))
            return;

        $target_image = "images_article/" . $file_image_name;

        // unlink("../../images_article/$file_image_name");

        $sql_article = "UPDATE `articles` SET `title` = '$title', `content` = '$content', `image` = '$target_image'
        WHERE articles.articleId = $article_id 
        AND articles.authorId = $user_id";
        if ($conn->error)
            echo 'Error inserting file: ' . $conn->error;
    }

    if (!empty ($_FILES['files']['name'][0])) {
        $sql_article_update = "UPDATE `articles` SET `title` = ?, `content` = ? WHERE `articleId` = ? AND `authorId` = ?";
        $sql_files_insert = "INSERT INTO `files` (`articleId`, `fileName`, `filePath`) VALUES (?, ?, ?)";
        $sql_files_delete = "DELETE FROM `files` WHERE `articleId` = ? AND `filePath` = ?"; // Exclude matching paths

        $uploadOk = true;

        // Prepare statements for database operations
        $stmt_article_update = $conn->prepare($sql_article_update);
        $stmt_files_delete = $conn->prepare($sql_files_delete);
        $stmt_files_insert = $conn->prepare($sql_files_insert);

        $existing_file_paths = []; // Array to store existing file paths

        // Fetch existing file paths from database for comparison
        $stmt_get_files = $conn->prepare("SELECT `filePath` FROM `files` WHERE `articleId` = ?");
        $stmt_get_files->bind_param("i", $article_id);
        $stmt_get_files->execute();
        $result = $stmt_get_files->get_result(); // Get results
        while ($row = $result->fetch_assoc()) {
            $existing_file_paths[] = $row['filePath'];
        }
        $stmt_get_files->close();

        foreach ($existing_file_paths as $existing_file_path) {
            $stmt_files_delete->bind_param("is", $article_id, $existing_file_path);
            $deleted = $stmt_files_delete->execute(); // Delete old files (excluding the new one)
            if ($conn->error) {
                echo 'Error deleting old files: ' . $conn->error;
                break;
            }
        }

        foreach ($_FILES["files"]["name"] as $key => $value) {
            $file_name = basename($value);
            $target_file = $target_dir_files . $file_name;
            $file_path = "files/" . $file_name;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (!check_file($file_name, $_FILES["files"]["tmp_name"][$key], $imageFileType, $_FILES["files"]["size"][$key], $target_dir_files)) {
                $uploadOk = false;
                break;
            }

            // Bind parameters and insert file data, excluding duplicates
            if (!in_array($target_file, $existing_file_paths)) {
                $stmt_files_insert->bind_param("iss", $article_id, $file_name, $file_path);
                $stmt_files_insert->execute();
                if ($conn->error) {
                    echo 'Error inserting file: ' . $conn->error;
                    break;
                }
            }
            // Move uploaded file
            if (!move_uploaded_file($_FILES["files"]["tmp_name"][$key], $target_file)) {
                echo "Sorry, there was an error uploading file: " . $file_name;
                break;
            }
        }
    }

    $_SESSION['return'] = "Your article have been updated successfully.";
    echo "<script>window.location.href = 'index.php?page=magazineStudent';</script>";

}
?>