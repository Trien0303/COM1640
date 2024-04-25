<!-- footer -->
<footer style="position: absolute; bottom: 0%; width: 100%; margin: 0 auto">
    <div class="container-xl">
        <div class="footer-inner">
            <div class="row d-flex align-items-center gy-4">
            </div>
        </div>
    </div>
</footer>

</div><!-- end site wrapper -->

<!-- search popup area -->
<div class="search-popup">
    <!-- close button -->
    <button type="button" class="btn-close" aria-label="Close"></button>
    <!-- content -->
        <!-- form -->
        <form class="d-flex search-form">
            <input class="form-control me-2" type="search" placeholder="Search and press enter ..." aria-label="Search">
            <button class="btn btn-default btn-lg" type="submit"><i class="icon-magnifier"></i></button>
        </form>
    </div>
</div>

<!-- canvas menu -->
<div class="canvas-menu d-flex align-items-end flex-column">
    <!-- close button -->
    <button type="button" class="btn-close" aria-label="Close"></button>

    <!-- logo -->
    <div class="logo">
        <img src="images/logo.svg" alt="Katen" />
    </div>
</div>
<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php
<<<<<<< HEAD

$username = $_SESSION['username']; 


=======
// Lấy thông tin đăng nhập của người dùng từ session
$username = $_SESSION['username']; // Giả sử bạn lưu username trong session

// Truy vấn cơ sở dữ liệu để lấy thông tin về người dùng, bao gồm cả facultyId
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7
$user_query = "SELECT * FROM users WHERE username = '$username'";
$user_result = $conn->query($user_query);

if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $user_faculty_id = $user_row['facultyId'];

    // Select article that public and belong to the user's faculty
    $spl_articles_approved = "SELECT * FROM `articles`
                            INNER JOIN users ON articles.authorId = users.userId
                            WHERE articles.showStatus = 1 AND users.facultyId = $user_faculty_id";
    $result = $conn->query($spl_articles_approved);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>      
            <div class="card-header">
                <div class="col">
<<<<<<< HEAD
                    <div class="card h-100 ">
=======
                    <div class="card h-100 " style="height: 100px;">
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7
                        <img src="<?= $row['image'] ?>" class="card-img-top" alt="<?= basename($row['image']) ?>">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $row["title"] ?>
                            </h5>
                            <p class="card-text">
                                <?= $row['content'] ?>
                            </p>
                        </div>
                        <div class="card-footer" style="display: flex; align-items: center; justify-content: space-between;">
                            <small class="text-body-secondary">
                                <?= $row['submitDate'] ?>
                            </small>
                            <form action="download.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="articlePublicId" id="articlePublicId" value="<?= $row['articleId'] ?>">
                                <button type="submit" class="btn btn-primary btn-floating">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-download" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                        <path
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        echo "No data found!";
    }
} else {
<<<<<<< HEAD

    echo "No data of user.";
=======
    // Xử lý khi không tìm thấy thông tin người dùng
    echo "Không tìm thấy thông tin người dùng.";
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7
}
?>

    </div>
</div>