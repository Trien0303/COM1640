<style>
    /* Tùy chỉnh kích thước bảng */
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    /* Tùy chỉnh đường viền cho table, header và body */
    .table,
    .table th,
    .table td {
        border: 1px solid #dee2e6;
    }

    /* Tùy chỉnh màu nền cho header */
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        background-color: #f8f9fa;
    }

    /* Tùy chỉnh kích thước của các header */
    .table th {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 0;
        border-bottom-width: 2px;
        text-align: center;
    }

    /* Tùy chỉnh kích thước của các ô */
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 0;
        text-align: center;
    }

    /* Đặt màu nền cho tất cả các dòng */
    .table-striped tbody tr,
    .table tbody tr {
        background-color: rgba(0, 0, 0, 0.05);
        /* Màu nền cho tất cả các dòng */
    }

    /* Tùy chỉnh màu hover cho các dòng */
    .table tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.075);
        /* Màu nền khi hover */
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
        /* hoặc bạn có thể sử dụng margin: 20px; */
    }
</style>
<?php
if (isset($_SESSION['return']) && $_SESSION['return'] !== null) {
    $title =  $_SESSION['return']; // Tạo tiêu đề có chứa $_SESSION['return']
    echo "<script>";
    echo "Swal.fire({";
    echo "    position: 'center',";
    echo "    icon: 'success',";
    echo "    title: '$title',";
    echo "    showConfirmButton: false,";
    echo "    timer: 3000";
    echo "});";
    echo "</script>";

    unset($_SESSION['return']);
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h2 class="card-title fw-semibold mb-4 text-center">Annual University Magazine Management</h2>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">

                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Closure Date</th>
                                        <th scope="col">Final Closure Date</th>
                                        <th scope="col">Year accept</th>
                                        <th scope="col">Adding the Article</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Truy vấn SQL để lấy dữ liệu từ bảng magazines
                                    $sql = "SELECT * FROM magazine";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td class="align-middle"><?php echo ($row["magazineName"]) ?></td>
                                                <td class="align-middle"><?php echo ($row["magazineDescription"]) ?></td>
                                                <td class="align-middle"><?php echo ($row["closureDate"]) ?></td>
                                                <td class="align-middle"><?php echo ($row["finalClosureDate"]) ?></td>
                                                <td class="align-middle"><?php echo ($row["magazineYear"]) ?></td>
                                                <td class="align-middle">
                                                    <a href="?page=addArticleStudent&id=<?php echo ($row["magazineId"]) ?>" class="btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                            <path d="M7 0h2v16H7V0z" />
                                                            <path d="M0 7v2h16V7H0z" />
                                                        </svg>
                                                    </a>
                                                </td>

                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No data found.";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>