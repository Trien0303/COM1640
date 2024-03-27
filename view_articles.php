<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <style>
        .table th {
            background-color: #f2f2f2;
            /* Màu nền */
            color: #333;
            /* Màu chữ */
            font-weight: bold;
            /* Độ đậm của chữ */
            padding: 10px;
            /* Khoảng cách giữa nội dung và viền */
            text-align: center;
            /* Căn giữa nội dung */
        }

        /* CSS cho các ô dữ liệu */
        .table td {
            padding: 10px;
            /* Khoảng cách giữa nội dung và viền */
            text-align: left;
            /* Căn trái nội dung */
        }
    </style>
    <?php
    include_once("connect.php");
    $articleId = $_GET['articleId'];
    $fileSql = "SELECT * FROM files WHERE articleId = $articleId";
    $fileResult = $conn->query($fileSql);
    $sql = "SELECT articles.*, magazineName, users.Name as authorName FROM articles
        INNER JOIN users ON articles.authorId = users.userId
        INNER JOIN magazine ON magazine.magazineId = articles.magazineId
        WHERE articleId = $articleId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the data
        $row = $result->fetch_assoc();
        echo '<div class="table-responsive table-responsive-x5">';
        echo '<table class="table table-bordered">';
        echo '<tr>';
        echo '<th>Name Article</th>';
        echo '<td>' . $row["title"] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>Article Content</th>';
        echo '<td>' . $row["content"] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>Submission Date</th>';
        echo '<td>' . $row["submitDate"] . '</td>';
        echo '</tr>';
        if ($row['showStatus'] == 1) {
            echo '<tr>';
            echo '<th>Public Date</th>';
            echo '<td>' . $row["publicDate"] . '</td>';
            echo '</tr>';
        }

        echo '<tr>';
        echo '<th>Magazine</th>';
        echo '<td>' . $row["magazineName"] . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>Status</th>';
        echo '<td>';
        switch ($row["status"]) {
            case 0:
                echo 'Pending';
                break;
            case 1:
                echo 'Approved';
                break;
            case 2:
                echo 'Rejected';
                break;
            default:
                echo 'Unknown';
                break;
        }
        echo '</td>';
        echo '</tr>';
        if ($fileResult->num_rows > 0) {
            echo '<tr>';
            echo '<th>Files</th>';
            echo '<td>';
            $firstFile = true; // Variable to check the first time in the loop
            while ($fileRow = $fileResult->fetch_assoc()) {
                if (!$firstFile) {
                    echo '<br>'; // Add a new line (line break) before the second file onwards
                } else {
                    $firstFile = false; // Mark the first time passed
                }
                echo '<a href="' . $fileRow['filePath'] . '" download>' . $fileRow['fileName'] . '</a>';
            }
            echo '</td>';
            echo '</tr>';
        } else {
            echo '<p>No files found for this article.</p>';
        }
        echo '<tr>';
        echo '<th>Article Image</th>';
        echo '<td><img src="images_article/' . basename($row["image"]) . '" alt="Article Image" width="200"></td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';

        // Query to retrieve comments for the article
        $commentSql = "SELECT comments.*, users.name as authorName, users.email  FROM comments
        INNER JOIN users ON comments.authorId = users.userId
        WHERE articleId = $articleId";

        $commentResult = $conn->query($commentSql);

        if ($commentResult->num_rows > 0) {
            echo '<div class="container mt-4">';
            echo '<h6 class="modal-title">Comments:</h6>';
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            while ($commentRow = $commentResult->fetch_assoc()) {
                echo '<div>';
                echo '<h6 class="card-subtitle mb-3 me-2 text-primary">' . $commentRow['authorName'] . ': </h6>';
                echo '<p class="card-text">' . $commentRow['content'] . '</p>';
                echo '<small class="text-muted me-2 ">' . $commentRow['commentDate'] . '</small>';
                echo '<br>';
                echo '<smail class="card-subtitle mb-3 me-2">(' . $commentRow['email'] . ') </smail>';
                echo '<br>';
                echo '</div>';
                echo '<div class="d-flex" style="align-items: baseline;">';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="container mt-4">';
            echo '<p>No comments found for this article.</p>';
            echo '</div>';
        }
    } else {
        echo 'Article information not found.';
    }
    ?>
    <script>
        $(document).ready(function() {
            $('.btn-edit-comment').click(function() {
                var commentId = $(this).data('comment-id');
                var content = $(this).data('comment-content');
                openCommentModal(commentId, content);
            });
        });

        function openCommentModal(commentId, content) {
            $('#commentModal .modal-title').text('Edit Comment');
            $('#commentModal #commentId').val(commentId);
            $('#commentModal #commentText').val(content);
            $('#commentModal').modal('show');
        }


        function deleteComment(commentId) {
            // Hiển thị cửa sổ xác nhận bằng SweetAlert2
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this comment!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu người dùng xác nhận xóa, thực hiện gửi yêu cầu xóa comment
                    $.ajax({
                        url: '../../Backend/delete_comment.php',
                        type: 'POST',
                        data: {
                            commentId: commentId
                        },
                        success: function(response) {
                            // Xử lý phản hồi từ server nếu cần
                            console.log(response);
                            // Tải lại trang để cập nhật danh sách comment
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            // Hiển thị thông báo lỗi nếu có lỗi xảy ra
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR',
                                text: 'An error occurred while the system attempted to delete the comment. Please try again.'
                            });
                        }
                    });
                }
            });
        }
    </script>
</body>