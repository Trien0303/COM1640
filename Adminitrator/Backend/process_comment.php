<?php
session_start();

include_once ("../../connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $content = $_POST["commentText"];
    $articleId = $_POST["articleId"];
    $commentId = $_POST["commentId"];

    $commentDate = date("Y-m-d H:i:s");
    $authorId = $_SESSION['userid'];


    if (empty ($commentId)) {

        $sql = "INSERT INTO `comments` (`content`, `commentDate`, `articleId`, `authorId`) VALUES ('$content', '$commentDate', '$articleId', '$authorId')";
    } else {
        $sql = "UPDATE `comments` SET `content` = '$content', `commentDate` = '$commentDate' WHERE `commentId` = $commentId";
    }

    if ($conn->query($sql) === TRUE) {
        if (empty ($commentId)) {
            echo "Comment added successfully.";
        } else {

            echo "Comment updated successfully.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $conn->close();
} else {
    echo "Invalid request.";
}
?>