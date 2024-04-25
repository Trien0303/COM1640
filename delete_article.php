<?php

include 'connect.php'; 


if(isset($_POST['articleId'])) {

    $articleId = $_POST['articleId'];

    $sql_delete_article = "DELETE FROM articles WHERE articleId = ?";
    $stmt = $conn->prepare($sql_delete_article);
    $stmt->bind_param("i", $articleId);

    if ($stmt->execute()) {

        echo 'success';
    } else {

        echo 'error';
    }


    $stmt->close();
    $conn->close();
}
?>
