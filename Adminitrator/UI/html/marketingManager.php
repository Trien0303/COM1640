<?php

include_once("../../../connect.php");
require '../../../permissions.php';
require '../../../download.php';

checkAccess([ROLE_ADMIN, ROLE_UNIVERSITY_MARKETING_MANAGER, ROLE_MARKETING_COORDINATOR], $conn);



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
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
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
                include_once("sidebar.php");
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
            include_once("header.php");
            ?>
            <!--  Header End -->


            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12 d-flex align-items-stretch">
                                <div class="card w-100">
                                    <div class="card-body p-10">
                                        <h5 class="card-title fw-semibold mb-4">Articles Management</h5>


                                        <div><br></div>


                                        <div class="table-responsive">
                                            <table id="dataTableExample" class="table text-nowrap mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <form action="../../../download.php" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="articlePublicId" id="articlePublicId" value="<?= $row['articleId'] ?>">
                                                                <button type="submit" class="btn btn-primary btn-floating">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <th class="border-bottom-0 d-flex justify-content-center align-items-center">

                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Title of article</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Submit date</h6>
                                                        </th>
                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Magazine Name</h6>
                                                        </th>

                                                        <th class="border-bottom-0">
                                                            <h6 class="fw-semibold mb-0">Status public</h6>
                                                        </th>

                                                        <?php
                                                        if ($userRole != ROLE_ADMIN && $userRole != ROLE_UNIVERSITY_MARKETING_MANAGER) {
                                                        ?>
                                                            <<th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">Action</h6>
                                                                </th>
                                                            <?php
                                                        } else {
                                                        } ?>

                                                    </tr>
                                                </thead>
                                                <?php
                                                $username = $_SESSION['username']; 
                                                $user_query = "SELECT * FROM users WHERE username = '$username'";
                                                $user_result = $conn->query($user_query);

                                                if ($user_result->num_rows > 0) {
                                                    $user_row = $user_result->fetch_assoc();
                                                    $user_id = $user_row['userId'];

                                                    
                                                    $role_query = "SELECT roleId FROM users WHERE userId = '$user_id'";
                                                    $role_result = $conn->query($role_query);

                                                    if ($role_result->num_rows > 0) {
                                                        $role_row = $role_result->fetch_assoc();
                                                        $user_role = $role_row['roleId'];

                                                        
                                                        if ($user_role == "1" || $user_role == "4") {
                                                            
                                                            $sql_articles = "SELECT articles.*, magazine.magazineName 
                                                                             FROM articles 
                                                                             INNER JOIN magazine ON articles.magazineId = magazine.magazineId";
                                                        } else {
                                                           
                                                            $user_faculty_id = $user_row['facultyId']; 
                                                            $sql_articles = "SELECT articles.*, magazine.magazineName 
                                                                             FROM articles 
                                                                             INNER JOIN magazine ON articles.magazineId = magazine.magazineId 
                                                                             INNER JOIN users ON articles.authorId = users.userId
                                                                             WHERE users.facultyId = $user_faculty_id";
                                                        }

                                                        $result = $conn->query($sql_articles);
                                                    }


                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                ?>
                                                            <tr>
                                                                <td class="border-bottom-0 d-flex justify-content-center align-items-center">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <form action="../../../download.php" method="post" enctype="multipart/form-data">
                                                                            <input type="hidden" name="articlePublicId" id="articlePublicId" value="<?= $row['articleId'] ?>">
                                                                            <button type="submit" class="btn btn-primary btn-floating">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                                                                                </svg>
                                                                            </button>
                                                                        </form>
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
                                                                        <?= $row['magazineName'] ?>
                                                                    </h6>
                                                                </td>
                                                                <td class="border-bottom-0">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        <span class="badge <?= $row['showStatus'] == 0 ? 'bg-danger' : 'bg-primary' ?> rounded-3 fw-semibold">
                                                                            <?= $row['showStatus'] == 0 ? 'None' : 'Public' ?>
                                                                        </span>
                                                                    </div>
                                                                </td>

                                                                <td class="border-bottom-0">
                                                                    <?php
                                                                    if ($userRole != ROLE_ADMIN && $userRole != ROLE_UNIVERSITY_MARKETING_MANAGER) {
                                                                    ?>
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <label class="switch" onclick="toggleStatus(this, <?= $row['articleId']; ?>)">
                                                                                <input type="checkbox" <?= ($row["showStatus"] == 1) ? 'checked' : ''; ?>>
                                                                                <span class="slider"></span>
                                                                            </label>
                                                                        </div>
                                                                    <?php
                                                                    } else {
                                                                        // Add any additional content for admin users if needed
                                                                    }
                                                                    ?>

                                                                </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    } else {
                                                        echo "No data found!";
                                                    }
                                                } else {
                                                   
                                                    echo "Không tìm thấy thông tin người dùng.";
                                                }
                                                ?>



                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <?php
            include_once("footer.php");
            ?>
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

         
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../../Backend/update_showStatus.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                 
                    var response = JSON.parse(xhr.responseText);
                    
                    var badgeClass = response.badgeClass;
                    var showStatus = response.showStatus;
                   
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