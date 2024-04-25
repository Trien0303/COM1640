<?php

include_once("../../connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $commentId = $_POST["commentId"];


    $deleteSql = "DELETE FROM comments WHERE commentId = $commentId";

    if ($conn->query($deleteSql) === TRUE) {

        echo "Comment deleted successfully.";
    } else {

        echo "Error: " . $deleteSql . "<br>" . $conn->error;
    }


    $conn->close();
} else {

    echo "Invalid request.";
}
?>
