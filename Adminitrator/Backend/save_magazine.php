<?php

include_once("../../connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $magazineId = $_POST['magazineId'];
    $magazineName = $_POST['magazineName'];
    $magazineDescription = $_POST['magazineDescription'];
    $magazineClosureDate = date("Y-m-d", strtotime($_POST['magazineClosureDate']));
$magazineFinalClosureDate = date("Y-m-d", strtotime($_POST['magazineFinalClosureDate']));
    $magazineYear = $_POST['magazineYear'];


    if (empty($magazineId)) {

        $query = "INSERT INTO magazine (magazineName, magazineDescription, closureDate, finalClosureDate, magazineYear) 
                  VALUES ('$magazineName', '$magazineDescription', '$magazineClosureDate', '$magazineFinalClosureDate', '$magazineYear')";
        
        if ($conn->query($query) === TRUE) {
  
            echo "New magazine created successfully";
        } else {
          
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
     
        $query = "UPDATE magazine
                  SET magazineName='$magazineName', magazineDescription='$magazineDescription', closureDate='$magazineClosureDate', finalClosureDate='$magazineFinalClosureDate', magazineYear='$magazineYear' 
                  WHERE magazineId=$magazineId";
        
        if ($conn->query($query) === TRUE) {
  
            echo "Magazine updated successfully";
        } else {
     
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }


    $conn->close();
}
?>
