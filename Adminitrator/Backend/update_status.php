<?php
include_once("../../connect.php");

if (isset($_POST['articleId']) && isset($_POST['status'])) {
    $articleId = $_POST['articleId'];
    $status = $_POST['status'];

    $sql = "UPDATE articles SET status = $status WHERE articleId = $articleId";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật trạng thái thành công";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Không có dữ liệu gửi từ phía client";
}

$conn->close();
?>
