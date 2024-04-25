<?php
include_once("../../connect.php");


if (isset($_POST['userId']) && isset($_POST['status'])) {
    $userId = $_POST['userId'];
    $status = $_POST['status'];


    $sql = "UPDATE users SET status = $status WHERE userId = $userId";
    if ($conn->query($sql) === TRUE) {
        echo "User status updated successfully";
    } else {
        echo "Error updating user status: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>
