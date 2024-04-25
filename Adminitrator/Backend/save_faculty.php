<?php

include_once("../../connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $facultyId = $_POST['facultyId'];
    $facultyName = $_POST['facultyName'];


    if (empty($facultyId)) {


        $query = "INSERT INTO faculties (facultyName) 
                  VALUES ('$facultyName')";
        
        if ($conn->query($query) === TRUE) {
            
            echo "New faculty created successfully";
        } else {
            
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
    else {

        $query = "UPDATE faculties
                  SET facultyName='$facultyName' 
                  WHERE facultyId=$facultyId";
        
        if ($conn->query($query) === TRUE) {

            echo "Faculty updated successfully";
        } else {
          
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }


    $conn->close();
}

?>
