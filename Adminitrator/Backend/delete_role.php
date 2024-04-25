<?php

include_once("../../connect.php");


require_once '../../permissions.php';
checkAccess([ROLE_ADMIN], $conn);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['role_id'])) {

        $role_id = $_POST['role_id'];


        $sql = "DELETE FROM roles WHERE roleId = ?";
        

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("i", $role_id);
        

        if ($stmt->execute()) {

            echo "Role has been deleted successfully.";
        } else {

            echo "Error: " . $conn->error;
        }

        $stmt->close();
    } else {

        echo "Role ID is missing.";
    }
} else {

    echo "Invalid request method.";
}
?>
