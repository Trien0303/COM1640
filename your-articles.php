<style>
    /* Tùy chỉnh kích thước bảng */
    .tableEdit {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    /* Tùy chỉnh đường viền cho table, header và body */
    .tableEdit,
    .tableEdit th,
    .tableEdit td {
        border: 1px solid #dee2e6;
    }

    /* Tùy chỉnh màu nền cho header */
    .tableEdit thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        background-color: #f8f9fa;
    }

    /* Tùy chỉnh kích thước của các header */
    .tableEdit th {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 0;
        border-bottom-width: 2px;
        text-align: center;
    }

    /* Tùy chỉnh kích thước của các ô */
    .tableEdit td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 0;
        text-align: center;
    }

    /* Tùy chỉnh màu chẵn lẻ cho các dòng */
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }

    /* Tùy chỉnh màu hover cho các dòng */
    .tableEdit tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.075);
    }

    .card {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        border-radius: 1rem !important;
        transition: transform 0.3s ease;
    }

    /* Bo tròn các góc của thẻ card */
    .card {
        border-radius: 1rem !important;
    }

    /* Hiệu ứng bo tròn cho nút */
    .btn-primary {
        border-radius: 1.5rem !important;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: #212529;
    }

    /* Tùy chỉnh responsive */
    @media (max-width: 575.98px) {
        .table-responsive-sm {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        .table-responsive-sm>.table-bordered {
            border: 0;
        }
    }

    .table-container {
        padding: 20px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container-fluid">
    <div class="card">

        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <h2 class="card-title fw-semibold mb-4 text-center">Your Table Uploaded-Article</h2>
                <br>
                <div class="table-responsive">
                    <table class="table tableEdit table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Submit Date</th>
                                <th>Action</th>
                                <th>View The Article</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $userId = $_SESSION['userid'];
                            // Select articles of user
                            $sql_user_articles = "SELECT * FROM `articles` WHERE authorId = (SELECT userId FROM users WHERE userId = $userId )";
                            $result = $conn->query($sql_user_articles);
                            

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                     
                                   
                                    $currentDate = date("Y-m-d");

                                 
                                    $sql_final_closure_date = "SELECT finalClosureDate FROM magazine WHERE magazineId = ?";
                                    $stmt = $conn->prepare($sql_final_closure_date);
                                    $stmt->bind_param("i", $row['magazineId']);
                                    $stmt->execute();
                                    $result_final_closure_date = $stmt->get_result();

                                
                                    $disabled = "";
                                    if ($result_final_closure_date->num_rows > 0) {
                                        $finalClosureDate_row = $result_final_closure_date->fetch_assoc();
                                        $finalClosureDate = $finalClosureDate_row['finalClosureDate'];
                                        if ($currentDate > $finalClosureDate) {
                                            $disabled = "disabled";
                                        }
                                    }
                                    $stmt->close();
                            ?>
                                    <tr>
                                        <td><?= $row['title'] ?></td>
                                        <td><?= $row['content'] ?></td>
                                        <td><?= $row['submitDate'] ?></td>
                                        <td>
                                            <form action="download.php" method="post" enctype="multipart/form-data" class="d-inline-block me-2">
                                                <input type="hidden" name="articleUserId" id="articleUserId" value="<?= $row['articleId'] ?>">
                                                <button type="submit" class="btn btn-info view-article-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <a href="?page=updateArticleStudent&id=<?= $row['articleId'] ?>" class="btn btn-info view-article-btn <?= $disabled ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                                </svg>
                                            </a>
                                            
                                                <a href="#" class="btn btn-danger delete-article-btn" data-article-id="<?= $row['articleId'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M3.5 2.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5V3h-9v-.5zM2 3a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v.5a.5.5 0 0 1-.5.5H2.5a.5.5 0 0 1-.5-.5V3z" />
                                                        <path fill-rule="evenodd" d="M11.5 5a.5.5 0 0 1 .5.5V13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5.5a.5.5 0 0 1 1 0V13a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V5.5a.5.5 0 0 1 .5-.5z" />
                                                        <path fill-rule="evenodd" d="M4.5 1a.5.5 0 0 1 .5.5V3h7V1.5a.5.5 0 0 1 1 0V3a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V1.5a.5.5 0 0 1 .5-.5z" />
                                                    </svg>
                                                </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info view-article-btn" data-article-id="<?= $row['articleId'] ?>" data-bs-toggle="modal" data-bs-target="#viewArticleModal"> Show </button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4">No data found!</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewArticleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Article Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Article details will be displayed here -->
                <div id="articleDetails"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- canvas menu -->
<div class="canvas-menu d-flex align-items-end flex-column">
    <!-- close button -->
    <button type="button" class="btn-close" aria-label="Close"></button>
</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $('.view-article-btn').click(function() {
        var articleId = $(this).data('article-id');
        $.ajax({
            url: 'view_articles.php',
            type: 'POST',
            data: {
                articleId: articleId
            },
            success: function(response) {
                $('#articleDetails').html(response);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
       
        $('.delete-article-btn').click(function(e) {
            e.preventDefault(); 
            var articleId = $(this).data('article-id'); 
            if (confirm("Are you sure you want to delete this article?")) {   
                          $.ajax({
                    url: 'delete_article.php', 
                    type: 'POST',
                    data: {
                        articleId: articleId 
                    },
                    success: function(response) {
                        if (response == 'success') {
                            
                            location.reload();
                        } else {
                            
                            alert('Failed to delete article. Please try again later.');
                        }
                    }
                });
            }
        });
    });
</script>