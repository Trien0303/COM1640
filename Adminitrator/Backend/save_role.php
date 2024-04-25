<?php

include_once("../../connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $roleId = $_POST['roleId'];
    $roleName = $_POST['roleName'];


    if (empty($roleId)) {

        $query = "INSERT INTO roles (roleName)
                  VALUES ('$roleName')";
        
        if ($conn->query($query) === TRUE) {
    
            echo "New role created successfully";
        } else {
            
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {

        $query = "UPDATE roles
                  SET roleName='$roleName'
                  WHERE roleId=$roleId";
        
        if ($conn->query($query) === TRUE) {
         
            echo "Role updated successfully";
        } else {
           
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }

  
    $conn->close();
}
?>

