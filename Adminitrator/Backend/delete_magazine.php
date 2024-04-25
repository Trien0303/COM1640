<?php

session_start();
include_once("../../connect.php");


if (isset($_POST["magazineId"])) {

    $magazineId = $_POST["magazineId"];


    $sql = "DELETE FROM magazine WHERE magazineId = $magazineId";

    if ($conn->query($sql) === TRUE) {

        echo json_encode(["success" => true]);
    } else {

        echo json_encode(["success" => false, "message" => "Error deleting record: " . $conn->error]);
    }
} else {

    echo json_encode(["success" => false, "message" => "Magazine ID is missing"]);
}

?>
