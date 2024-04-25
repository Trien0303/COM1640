<?php

include_once("../../connect.php");


if (isset($_POST['articleId']) && isset($_POST['showStatus'])) {
    $articleId = $_POST['articleId'];
    $showStatus = $_POST['showStatus'];


    $sql = "UPDATE articles SET showStatus = $showStatus WHERE articleId = $articleId";


    if ($conn->query($sql) === TRUE) {

        $response = array("badgeClass" => "", "showStatus" => "");

        if ($showStatus == 0) {
            $response["badgeClass"] = "bg-danger";
            $response["showStatus"] = "None";
        } else {
            $response["badgeClass"] = "bg-primary";
            $response["showStatus"] = "Public";
        }

        echo json_encode($response);
    } else {
 
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
} else {

    echo "Không có dữ liệu gửi từ phía client";
}


$conn->close();
?>
