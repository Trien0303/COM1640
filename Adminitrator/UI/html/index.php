<?php


include_once("../../../connect.php");

require_once '../../../permissions.php';
// $userId = $_SESSION['userId'];
checkAccess([ROLE_ADMIN, ROLE_MARKETING_COORDINATOR, ROLE_UNIVERSITY_MARKETING_MANAGER], $conn);

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
    <link rel="stylesheet" href="../assets/assets_table/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/assets_table/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="../assets/assets_table/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <!-- End layout styles -->

    <link rel="shortcut icon" href="../assets/assets_table/images/favicon.png" />
</head>

<body>
    <style>
        .content-wrapper {
            overflow-y: auto;
            max-height: calc(100vh - 150px);
            /* Adjust the max height as needed */
        }
    </style>
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
                    $sql = "SELECT f.facultyId, f.facultyName, COUNT(a.articleId) AS numArticles
            FROM faculties f
            LEFT JOIN users u ON f.facultyId = u.facultyId
            LEFT JOIN articles a ON u.userId = a.authorId
            GROUP BY f.facultyId, f.facultyName";


                    $result = $conn->query($sql);

                    $data = array();
                    while ($row = $result->fetch_assoc()) {
                        $data[] = $row;
                    }

                    $data_json = json_encode($data);


                    ?>

                    <?php
                    $sqlMagazine = "SELECT m.magazineId, m.magazineName, COUNT(a.articleId) AS numArticles
        FROM magazine m
        LEFT JOIN articles a ON m.magazineId = a.magazineId
        GROUP BY m.magazineId, m.magazineName";

                    $resultMagazine = $conn->query($sqlMagazine);

                    $magazineData = array();
                    while ($rowMagazine = $resultMagazine->fetch_assoc()) {
                        $magazineData[] = $rowMagazine;
                    }
                    ?>
                    <?php
              
                    $articlesByYear = array();

                 
                    $sqlByYear = "SELECT YEAR(submitDate) AS submitYear, COUNT(*) AS numArticles
              FROM articles
              GROUP BY YEAR(submitDate)
              ORDER BY submitYear";
                    $resultByYear = $conn->query($sqlByYear);

                
                    while ($rowByYear = $resultByYear->fetch_assoc()) {
                        $submitYear = $rowByYear['submitYear']; 
                        $articlesByYear[$submitYear] = $rowByYear['numArticles']; 
                    }

                    
                    $articlesByYearJSON = json_encode($articlesByYear);
                    ?>

                    <?php
                    
                    $sqlfaculties = "SELECT f.facultyName,
               SUM(CASE WHEN a.status = 1 THEN 1 ELSE 0 END) AS numActivatedArticles,
               SUM(CASE WHEN a.status = 2 THEN 1 ELSE 0 END) AS numInactivatedArticles,
               SUM(CASE WHEN a.status = 0 THEN 1 ELSE 0 END) AS numPendingArticles
        FROM faculties f
        LEFT JOIN users u ON f.facultyId = u.facultyId
        LEFT JOIN articles a ON u.userId = a.authorId
        GROUP BY f.facultyName";

                    $resultfaculties = $conn->query($sqlfaculties);

                
                    $datafaculties = array();
                    while ($rowfaculties = $resultfaculties->fetch_assoc()) {
                        $datafaculties[] = $rowfaculties;
                    }

                    
                    $facultyNames = [];
                    $numActivatedArticles = [];
                    $numInactivatedArticles = [];
                    $numPendingArticles = [];

                    foreach ($datafaculties as $rowfaculties) {
                        $facultyNames[] = $rowfaculties['facultyName'];
                        $numActivatedArticles[] = $rowfaculties['numActivatedArticles'];
                        $numInactivatedArticles[] = $rowfaculties['numInactivatedArticles'];
                        $numPendingArticles[] = $rowfaculties['numPendingArticles'];
                    }
                    ?>


                    <?php
                   
                    $sqlMagazineApprovalRatio = "SELECT m.magazineName,
                                    SUM(CASE WHEN a.status = 1 THEN 1 ELSE 0 END) AS approvedArticles,
                                    SUM(CASE WHEN a.status = 2 THEN 1 ELSE 0 END) AS rejectedArticles,
                                    COUNT(a.articleId) AS totalArticles
                                FROM magazine m
                                LEFT JOIN articles a ON m.magazineId = a.magazineId
                                GROUP BY m.magazineId, m.magazineName";

                    $resultMagazineApprovalRatio = $conn->query($sqlMagazineApprovalRatio);

        
                    $approvalRatioData = array();
                    while ($rowMagazineApprovalRatio = $resultMagazineApprovalRatio->fetch_assoc()) {
                        $magazineName = $rowMagazineApprovalRatio['magazineName'];
                        $approvedArticles = $rowMagazineApprovalRatio['approvedArticles'];
                        $rejectedArticles = $rowMagazineApprovalRatio['rejectedArticles'];
                        $totalArticles = $rowMagazineApprovalRatio['totalArticles'];

                      
                        $approvalRatio = $totalArticles > 0 ? round(($approvedArticles / $totalArticles) * 100, 2) : 0;
                        $rejectionRatio = $totalArticles > 0 ? round(($rejectedArticles / $totalArticles) * 100, 2) : 0;

                        
                        $approvalRatioData[] = array(
                            'magazineName' => $magazineName,
                            'approvalRatio' => $approvalRatio,
                            'rejectionRatio' => $rejectionRatio
                        );
                    }
                    ?>

                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="row">
                                        <div class="col-lg-12 d-flex align-items-stretch">
                                            <div class="card w-100">
                                                <div class="card-body p-4 text-center">
                                                    <h5 class="card-title fw-semibold mb-4">Number of Articles by Year</h5>
                                                    <div class="chart-container" style="position: relative; height: 400px;">
                                                        <canvas id="yearChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-stretch">
                                        <div class="card w-100">
                                            <div class="card-body p-4 text-center">
                                                <h5 class="card-title fw-semibold mb-4">Number of Articles by Magazine</h5>
                                                <div class="chart-container" style="position: relative; height: 400px;">
                                                    <canvas id="magazineChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-stretch">
                                        <div class="card w-100">
                                            <div class="card-body p-4">
                                                <h5 class="card-title fw-semibold mb-4 text-center">Number of Articles by Faculty</h5>
                                                <div class="chart-container" style="position: relative; height: 400px;">
                                                    <canvas id="articleChart"></canvas>
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


    <!-- core:js -->
    <script src="../assets/assets_table/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="../assets/assets_table/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="../assets/assets_table/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="../assets/assets_table/vendors/feather-icons/feather.min.js"></script>
    <script src="../assets/assets_table/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="../assets/assets_table/js/data-table.js"></script>
    <!-- End custom js for this page -->


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.0.2"></script>

    <script>
        
        var data = <?php echo json_encode($data); ?>;

      
        var facultyNames = [];
        var numArticles = [];

        
        data.forEach(function(item) {
            facultyNames.push(item.facultyName); 
            numArticles.push(item.numArticles); 
        });

 
        var colors = ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)'];


        var ctx = document.getElementById('articleChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie', 
            data: {
                labels: facultyNames, 
                datasets: [{
                    label: 'Number of Articles', 
                    data: numArticles, 
                    backgroundColor: colors,
                    borderColor: colors.map(color => color.replace('0.5', '1')), 
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed;
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>


    <script>
        var magazineData = <?php echo json_encode($magazineData); ?>;

        var magazineNames = [];
        var numArticlesByMagazine = [];

        magazineData.forEach(function(item) {
            magazineNames.push(item.magazineName);
            numArticlesByMagazine.push(item.numArticles);
        });

        var magazineColors = ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)'];

        var magazineCtx = document.getElementById('magazineChart').getContext('2d');
        var magazineChart = new Chart(magazineCtx, {
            type: 'pie',
            data: {
                labels: magazineNames,
                datasets: [{
                    label: 'Number of Articles',
                    data: numArticlesByMagazine,
                    backgroundColor: magazineColors,
                    borderColor: magazineColors.map(color => color.replace('0.5', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed;
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        // Assume you have fetched data from the database and stored it in a variable named 'articlesByYear'
        var articlesByYear = <?php echo json_encode($articlesByYear); ?>;

        var years = Object.keys(articlesByYear);
        var numArticles = Object.values(articlesByYear);

        var ctx = document.getElementById('yearChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: years,
                datasets: [{
                    label: 'Number of Articles',
                    data: numArticles,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)', 
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('facultyChart').getContext('2d');
        var facultyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($facultyNames); ?>,
                datasets: [{
                    label: 'Activated Articles',
                    data: <?php echo json_encode($numActivatedArticles); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                }, {
                    label: 'Inactivated Articles',
                    data: <?php echo json_encode($numInactivatedArticles); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)'
                }, {
                    label: 'Pending Articles',
                    data: <?php echo json_encode($numPendingArticles); ?>,
                    backgroundColor: 'rgba(255, 206, 86, 0.5)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        
        var approvalRatioData = <?php echo json_encode($approvalRatioData); ?>;

       
        var magazineNames = [];
        var approvalRatios = [];
        var rejectionRatios = [];

        
        approvalRatioData.forEach(function(item) {
            magazineNames.push(item.magazineName);
            approvalRatios.push(item.approvalRatio); 
            rejectionRatios.push(item.rejectionRatio);
        });

      
        var ctx = document.getElementById('approvalRatioChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: magazineNames, 
                datasets: [{
                    label: 'Approval Ratio (%)', 
                    data: approvalRatios, 
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', 
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Rejection Ratio (%)', 
                    data: rejectionRatios, 
                    backgroundColor: 'rgba(255, 99, 132, 0.5)', 
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true 
                    }
                }
            }
        });
    </script>
</body>

</html>