<?php
include_once("../../../connect.php");
require_once '../../../permissions.php';

checkAccess([ROLE_ADMIN], $conn);
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

    <link rel="shortcut icon" href="../assets/assets_table/images/favicon.png" />
    <style>
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

        .green {
            background-color: green;
            color: white;
        }

        .yellow {
            background-color: yellow;
            color: black;
        }

        .red {
            background-color: red;
            color: white;
        }

      
        .btn-primary {
            background: none;
            border: none;
        }

       
        .btn-primary svg {
            width: 20px;
            
            height: 20px;
            fill: blue;
           
        }

        .content-wrapper {
            overflow-y: auto;
            max-height: calc(100vh - 150px);
            /* Adjust the max height as needed */
        }

       
        .btn-primary {
           
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
            <br>
            <br>
            <br>
            <br>

            <div class="content-wrapper">
                <div class="container-fluid">
                    <?php
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);
                    ?>
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 d-flex align-items-stretch">
                                        <div class="card w-100">
                                            <div class="card-body p-4">

                                                <h5 class="card-title fw-semibold mb-4">Management Account</h5>
                                                <a href="./register.php">
                                                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#roleModal" style="background: none; border: none;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
                                                            <path d="M8 0q-.264 0-.523.017l.064.998a7 7 0 0 1 .918 0l.064-.998A8 8 0 0 0 8 0M6.44.152q-.52.104-1.012.27l.321.948q.43-.147.884-.237L6.44.153zm4.132.271a8 8 0 0 0-1.011-.27l-.194.98q.453.09.884.237zm1.873.925a8 8 0 0 0-.906-.524l-.443.896q.413.205.793.459zM4.46.824q-.471.233-.905.524l.556.83a7 7 0 0 1 .793-.458zM2.725 1.985q-.394.346-.74.74l.752.66q.303-.345.648-.648zm11.29.74a8 8 0 0 0-.74-.74l-.66.752q.346.303.648.648zm1.161 1.735a8 8 0 0 0-.524-.905l-.83.556q.254.38.458.793zM1.348 3.555q-.292.433-.524.906l.896.443q.205-.413.459-.793zM.423 5.428a8 8 0 0 0-.27 1.011l.98.194q.09-.453.237-.884zM15.848 6.44a8 8 0 0 0-.27-1.012l-.948.321q.147.43.237.884zM.017 7.477a8 8 0 0 0 0 1.046l.998-.064a7 7 0 0 1 0-.918zM16 8a8 8 0 0 0-.017-.523l-.998.064a7 7 0 0 1 0 .918l.998.064A8 8 0 0 0 16 8M.152 9.56q.104.52.27 1.012l.948-.321a7 7 0 0 1-.237-.884l-.98.194zm15.425 1.012q.168-.493.27-1.011l-.98-.194q-.09.453-.237.884zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a7 7 0 0 1-.458-.793zm13.828.905q.292-.434.524-.906l-.896-.443q-.205.413-.459.793zm-12.667.83q.346.394.74.74l.66-.752a7 7 0 0 1-.648-.648zm11.29.74q.394-.346.74-.74l-.752-.66q-.302.346-.648.648zm-1.735 1.161q.471-.233.905-.524l-.556-.83a7 7 0 0 1-.793.458zm-7.985-.524q.434.292.906.524l.443-.896a7 7 0 0 1-.793-.459zm1.873.925q.493.168 1.011.27l.194-.98a7 7 0 0 1-.884-.237zm4.132.271a8 8 0 0 0 1.012-.27l-.321-.948a7 7 0 0 1-.884.237l.194.98zm-2.083.135a8 8 0 0 0 1.046 0l-.064-.998a7 7 0 0 1-.918 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                                        </svg>
                                                    </button>
                                                </a>


                                                <br>
                                                <br>
                                                <div class="table-responsive">
                                                    <table id="dataTableExample" class="table text-nowrap mb-0 align-middle">
                                                        <thead class="text-dark fs-4">
                                                            <tr>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">UserName</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Name</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Email</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Address</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Faculty</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Role</h6>
                                                                </th>
                                                                <th class="border-bottom-0">
                                                                    <h6 class="fw-semibold mb-0">Status</h6>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if ($result->num_rows > 0) {
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo "<tr>";
                                                                    echo    "<td class='border-bottom-0'>";
                                                                    echo     "   <h6 class='fw-semibold mb-0'>" . $row["username"] . "</h6>";
                                                                    echo    "</td>";
                                                                    echo    "<td class='border-bottom-0'>";
                                                                    echo     "   <h6 class='fw-semibold mb-1'>" . $row["name"] . "</h6>";
                                                                    echo      "  <span class='fw-normal'></span>";
                                                                    echo    "</td>";
                                                                    echo   "<td class='border-bottom-0'>";
                                                                    echo    "<p class='mb-0 fw-normal'>" . $row["email"] . "</p>";
                                                                    echo "</td>";
                                                                    echo "<td class='border-bottom-0'>";
                                                                    echo "   <h6 class='fw-semibold mb-0 fs-4'>" . $row["address"] . "</h6>";
                                                                    echo "</td>";

                                                            ?>
                                                                    <td class='border-bottom-0'>
                                                                        <?php
                                                                       
                                                                        $facultyId = $row["facultyId"];

                                                                        if ($facultyId !== null) {
                                                                            $facultySql = "SELECT * FROM faculties WHERE facultyId = $facultyId";
                                                                            $facultyResult = $conn->query($facultySql);

                                                                            if ($facultyResult->num_rows > 0) {
                                                                                $facultyRow = $facultyResult->fetch_assoc();
                                                                                echo "<h6 class='fw-semibold mb-0 fs-4'>" . $facultyRow["facultyName"] . "</h6>";
                                                                            } else {
                                                                                echo "Unknown Faculty";
                                                                            }
                                                                        } else {
                                                                            echo "<h6 class='fw-semibold mb-0 fs-4'>No Faculty</h6>";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class='border-bottom-0'>
                                                                        <?php
<<<<<<< HEAD
                                                                      
=======
                                                                        // Lấy tên của vai trò từ bảng roles
>>>>>>> b39f62423b78a1b2a83dce1792d1fa4584f91fd7
                                                                        $roleId = $row["roleId"];
                                                                        $roleSql = "SELECT * FROM roles WHERE roleId = $roleId";
                                                                        $roleResult = $conn->query($roleSql);
                                                                        if ($roleResult->num_rows > 0) {
                                                                            $roleRow = $roleResult->fetch_assoc();
                                                                            echo "<h6 class='fw-semibold mb-0 fs-4'>" . $roleRow["roleName"] . "</h6>";
                                                                        } else {
                                                                            echo "Unknown role";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td class="border-bottom-0">
                                                                        <div class="d-flex align-items-center gap-2">
                                                                            <label class="switch" onclick="toggleStatus(this, <?php echo $row['userId']; ?>)">
                                                                                <input type="checkbox" <?php echo ($row["status"] == 1) ? 'checked' : ''; ?>>
                                                                                <span class="slider"></span>
                                                                            </label>
                                                                        </div>
                                                                    </td>

                                                            <?php
                                                                    echo "</td>";
                                                                    echo "</tr>";
                                                                }
                                                            } else {
                                                                echo "<tr><td colspan='4'>No users found.</td></tr>";
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



    <!-- Plugin js for this page -->
    <script src="../assets/assets_table/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="../assets/assets_table/vendors/datatables.net-bs5/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="../assets/assets_table/js/data-table.js"></script>
    <!-- End custom js for this page -->

    <script>
        function toggleStatus(label, userId) {
            var checkbox = label.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;

           
            xhr.open("POST", "../../Backend/update_status_user.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    
                    console.log(xhr.responseText);
                }
            };
            xhr.send("userId=" + userId + "&status=" + (checkbox.checked ? 1 : 0));
        }
    </script>

</body>

</html>