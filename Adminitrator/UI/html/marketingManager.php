<?php

include_once ("../../../connect.php");
require_once '../../../permissions.php';
checkAccess([ROLE_ADMIN, ROLE_UNIVERSITY_MARKETING_MANAGER], $conn);



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Management Privary</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />


    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/assets_table/vendors/datatables.net-bs5/dataTables.bootstrap4.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/assets_table/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="../assets/assets_table/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <!-- End layout styles -->

    <link rel="shortcut icon" href="../../assets/assets_table/images/favicon.png" />

    <style>
        #checkDefault.form-check-input {
            font-weight: bold;
            border: 1px solid black;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            border-radius: 24px;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            border-radius: 50%;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }
    </style>

</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>

                <!-- Sidebar navigation-->
                <?php
                include_once ("sidebar.php");
                ?>
                <!-- End Sidebar navigation -->

            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php
            include_once ("header.php");
            ?>
            <!--  Header End -->


            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12 d-flex align-items-stretch">
                                <div class="card w-100">
                                    <div class="card-body p-10">
                                        <h5 class="card-title fw-semibold mb-4">Articles is approved</h5>

                                        <h8>Welcome to Marketing Manager's dashboard! Here, you can</h8>
                                        <a href="#">download all </a>
                                        <h8>the documents you need for your work conveniently and quickly. Browse the
                                            list of documents and select the information needed to support your work.
                                        </h8>
                                        <div class="d-flex justify-content-end">
                                            <br>
                                            <div class="ms-auto">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Filter by Magazine
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                                                    </ul>
                                                </div>

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Filter by Faculty
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                                                    </ul>
                                                </div>

                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-primary me-2" id="downloadAll"
                                                        name="btnSubmit">
                                                        Download All
                                                    </button>
                                                </div>
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-primary me-2" id="downloadAll"
                                                        name="btnSubmit">
                                                        Download
                                                    </button>
                                                </div>



                                            </div>
                                        </div>
                                        <div><br></div>


                                        <div class="table-responsive">
                                            <table id="dataTableExample" class="table text-nowrap mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th
                                                            class="border-bottom-0 d-flex justify-content-center align-items-center">
                                                            <h6 class="fw-semibold mb-0">Download</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Title of article</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Submit date</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Magazine</h6>
                                                        </th>

                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Status public</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Action</h6>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $re = mysqli_query($conn, "SELECT * FROM articles WHERE status = 1");

                                                    while ($row = mysqli_fetch_assoc($re)) {
                                                        if ($row['magazineId'] == 1) {
                                                            $role = 'Magazine 1';
                                                        } elseif ($row['magazineId'] == 2) {
                                                            $role = 'student';
                                                        }
                                                        $showStatus = $row['showStatus'] == 0 ? 'None' : 'Public';
                                                        $badgeClass = $row['showStatus'] == 0 ? 'bg-danger' : 'bg-primary';
                                                        ?>
                                                        <tr>
                                                            <td
                                                                class="border-bottom-0 d-flex justify-content-center align-items-center">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="checkDefault">
                                                                </div>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-1">
                                                                    <?= $row['title'] ?>
                                                                </h6>
                                                                <span class="fw-normal">
                                                                    <?= $row['authorId'] ?>
                                                                </span>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <p class="mb-0 fw-normal">
                                                                    <?= $row['submitDate'] ?>
                                                                </p>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0 fs-4">
                                                                    <?= $row['magazineId'] ?>
                                                                </h6>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <span
                                                                        class="badge <?= $badgeClass ?> rounded-3 fw-semibold">
                                                                        <?= $showStatus ?>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                            <td class="border-bottom-0">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <label class="switch"
                                                                        onclick="toggleStatus(this, <?php echo $row['articleId']; ?>)">
                                                                        <input type="checkbox" <?php echo ($row["showStatus"] == 1) ? 'checked' : ''; ?>>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
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


                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



    <!-- core:js -->
    <script src="../assets/assets_table/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="../assets/assets_table/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="../assets/assets_table/vendors/datatables.net-bs5/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="../assets/assets_table/vendors/feather-icons/feather.min.js"></script>
    <script src="../assets/assets_table/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="../assets/assets_table/js/data-table.js"></script>
    <!-- End custom js for this page -->

    <script>
        function toggleStatus(label, articleId) {
    var checkbox = label.querySelector('input[type="checkbox"]');
    checkbox.checked = !checkbox.checked;
    
    // Gửi yêu cầu AJAX để cập nhật trạng thái trong cơ sở dữ liệu
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Backend/update_showStatus.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Xử lý phản hồi từ máy chủ
            var response = JSON.parse(xhr.responseText);
            // Cập nhật badgeClass và showStatus
            var badgeClass = response.badgeClass;
            var showStatus = response.showStatus;
            // Cập nhật badge trên giao diện
            var badgeElement = label.closest('tr').querySelector('.badge');
            badgeElement.className = "badge " + badgeClass + " rounded-3 fw-semibold";
            badgeElement.innerText = showStatus;
        }
    };
    xhr.send("articleId=" + articleId + "&showStatus=" + (checkbox.checked ? 1 : 0));
}


    </script>
</body>

</html>