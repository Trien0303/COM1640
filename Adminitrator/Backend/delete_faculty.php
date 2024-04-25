<?php

if (isset($_POST['faculty_id'])) {

    include_once("../../connect.php");


    $facultyId = $_POST['faculty_id'];


    $sql = "DELETE FROM faculties WHERE facultyId = $facultyId";

    if ($conn->query($sql) === TRUE) {

        echo json_encode(array("status" => "success", "message" => "Faculty deleted successfully."));
    } else {

        echo json_encode(array("status" => "error", "message" => "Error deleting faculty: " . $conn->error));
    }


    $conn->close();
} else {

    echo json_encode(array("status" => "error", "message" => "No faculty ID provided."));
}
?>
