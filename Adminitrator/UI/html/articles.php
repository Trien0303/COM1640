<?php
include_once('../../../connect.php');

require_once '../../../permissions.php';

checkAccess([ROLE_ADMIN, ROLE_MARKETING_COORDINATOR], $conn);
$userRole = getUserRole($conn);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Management Privary</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .no-click {
            pointer-events: none;
            opacity: 0.5;
        }

        /* CSS cho nút */
        .switch {
            display: inline-flex;
            /* Sử dụng flexbox để căn giữa chữ bên trong */
            align-items: center;
            /* Căn chữ theo chiều dọc */
            justify-content: center;
            /* Căn chữ theo chiều ngang */
            cursor: pointer;
            width: 70px;
            /* Điều chỉnh kích thước của nút */
            height: 30px;
            /* Điều chỉnh kích thước của nút */
            border-radius: 30px;
            /* Đảm bảo góc tròn cho nút */
            overflow: hidden;
            position: relative;
            background-color: #ccc;
            transition: background-color 0.4s;
        }

        /* CSS cho slider (nút trượt) */
        .slider {
            /* Các thuộc tính CSS cho slider */
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 30px;
            /* Đảm bảo góc tròn cho nút */
            transition: .4s;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            /* Màu chữ mặc định */
            font-size: 14px;
            /* Kích thước chữ */
        }

        /* Các trạng thái của slider */
        .slider.active {
            background-color: blue;
            /* Màu nền cho trạng thái active */
        }

        .slider.pending {
            background-color: yellow;
            /* Màu nền cho trạng thái pending */
            color: black;
        }

        .slider.inactive {
            background-color: red;
            /* Màu nền cho trạng thái inactive */
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
                <?php
                include_once("sidebar.php");
                ?>
            </div>
        </aside>
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php
            include_once("header.php");
            ?>
            <!--  Header End -->


            <?php
            // Truy vấn SQL để lấy dữ liệu từ bảng articles
            $userId = $_SESSION['userid'];
            $sql = "SELECT a.*, u.facultyId AS authorFacultyId, f.facultyName AS authorFacultyName
        FROM articles a
        INNER JOIN users u ON a.authorId = u.userId
        INNER JOIN faculties f ON u.facultyId = f.facultyId
        WHERE u.facultyId = (SELECT facultyId FROM users WHERE userId = '$userId')";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Bắt đầu bảng HTML
                echo '<div class="container-fluid">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<div class="row">';
                echo '<div class="col-lg-12 d-flex align-items-stretch">';
                echo '<div class="card w-100">';
                echo '<div class="card-body p-4">';
                echo '<h5 class="card-title fw-semibold mb-4">Article</h5>';
                echo '<br>';
                echo '<div class="table-responsive">';
                echo '<table id="dataTableExample" class="table text-nowrap mb-0 align-middle">';
                echo '<thead class="text-dark fs-4">';
                echo '<tr>';
                echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID</h6></th>';
                echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Title</h6></th>';
                echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Content</h6></th>';
                echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Submit Date</h6></th>';
                echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Deadline feedback</h6></th>';
                // echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Ahthor</h6></th>';
                // echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Magazine</h6></th>';
                // echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Image</h6></th>';
                echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Status</h6></th>';
                echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Detail</h6></th>';
                echo '<th class="border-bottom-0"><h6 class="fw-semibold mb-0">Comment</h6></th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                
                while ($row = $result->fetch_assoc()) {
                    $submitDate = strtotime($row["submitDate"]); 
                    $deadline = strtotime('tomorrow', strtotime('+14 days', $submitDate)) - 1; 
                    $currentDate = time(); 
                    $remainingTime = $deadline - $currentDate; 

            
                    $remainingDays = floor($remainingTime / (60 * 60 * 24));
                    $remainingHours = floor(($remainingTime % (60 * 60 * 24)) / (60 * 60));
                    $remainingMinutes = floor(($remainingTime % (60 * 60)) / 60);

                    $remainingResult =  "$remainingDays" . ' days ' . "$remainingHours" . ' hours ' . "$remainingMinutes" . ' minutes left';
                    
                    if ($remainingDays > 5) {
                        $colorClass = 'bg-primary';
                        $colorButton = 'btn-primary';
                        $lockButton = '';
                    } elseif ($remainingDays > 0) {
                        $colorClass = 'bg-warning';
                        $colorButton = 'btn-warning';
                        $lockButton = '';
                    } else {
                        $colorClass = 'bg-danger';
                        $remainingResult = "Expired";
                        $colorButton = 'btn-danger';
                        $lockButton = 'disabled';
                    }


                    echo '<tr>';
                    echo '<td class="border-bottom-0"><h6 class="fw-semibold mb-0">' . $row["articleId"] . '</h6></td>';
                    echo '<td class="border-bottom-0"><h6 class="fw-semibold mb-1">' . $row["title"] . '</h6></td>';
                    echo '<td class="border-bottom-0"><h6 class="fw-normal">' . $row["content"] . '</h6></td>';
                    echo '<td class="border-bottom-0"><p class="mb-0 fw-normal">' . $row["submitDate"] . '</p></td>';


                    echo '<td class="border-bottom-0"><div class="d-flex align-items-center gap-2" ><span class="badge ' . $colorClass . ' rounded-3 fw-semibold style="background-color:red;"">' . $remainingResult . ' </span></div></td>';
            ?>  
                    <td class="border-bottom-0 <?php echo ($row['showStatus'] == 1) ? 'no-click' : ''; ?>">
    <div class="d-flex align-items-center gap-2">
        <?php if ($userRole === ROLE_ADMIN): ?>
            <label class="switch" onclick="toggleStatus(this, <?php echo $row['articleId']; ?>)" disabled>
        <?php else: ?>
            <label class="switch" onclick="toggleStatus(this, <?php echo $row['articleId']; ?>)">
        <?php endif; ?>
            <input type="hidden" name="status<?php echo $row['articleId']; ?>" value="<?php echo $row['status']; ?>">
            <span class="slider <?php echo ($row["status"] == 1) ? 'active' : (($row["status"] == 0) ? 'pending' : 'inactive'); ?>">
                <?php echo ($row["status"] == 1) ? 'ACTIVE' : (($row["status"] == 0) ? 'PENDING' : 'INACTIVE'); ?>
            </span>
        </label>
    </div>
</td>


            <?php
                    echo '<td class="border-bottom-0">
                    <button type="button" class="btn btn-secondary btn-sm btn-view-details" data-article-id="' . $row["articleId"] . '">View Details</button>

                              </td>';
                    echo '<td class="border-bottom-0">
                              <button type="button" class="btn ' . $colorButton . ' btn-sm btn-comment" data-article-id="' . $row["articleId"] . '" ' . $lockButton . '>Comment</button>
                                        </td>';
                    echo '</tr>';
                }
              
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            } else {
                echo "Không có dữ liệu.";
            }

            ?>

        </div>
    </div>
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Article Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailsModalBody">
                  
                    <h6 class="modal-title">Comments</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Content</th>
                                <th scope="col">Comment Date</th>
                                <th scope="col">Author</th>
                            </tr>
                        </thead>
                        <tbody id="commentTableBody">
                            
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commentModalLabel">Add Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="commentForm">
                        <div class="mb-3">
                            <label for="commentText" class="form-label">Comment:</label>
                            <textarea class="form-control" id="commentText" name="commentText"></textarea>
                        </div>
                        <input type="hidden" id="articleId" name="articleId" value="">
                        <input type="hidden" id="commentId" name="commentId" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitComment">Submit</button>
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
    <script src="../assets/js/data-table.js"></script>
    <script src="../assets/js/jquery.dataTables.js"></script>

    <script>
      
            function toggleStatus(label, articleId) {
                var hiddenInput = label.querySelector('input[type="hidden"]');
                var slider = label.querySelector('.slider');

                var status = parseInt(hiddenInput.value);

                if (status === 0) {
                    status = 1;
                    slider.innerText = "ACTIVE"; 
                } else if (status === 1) {
                    status = 2;
                    slider.innerText = "INACTIVE"; 
                } else {
                    status = 0;
                    slider.innerText = "PENDING";
                }

                hiddenInput.value = status;

                slider.classList.remove('active', 'pending', 'inactive');
                if (status === 0) {
                    slider.classList.add('pending');
                } else if (status === 1) {
                    slider.classList.add('active');
                } else {
                    slider.classList.add('inactive');
                }

                
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../../Backend/update_status.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                       
                        console.log(xhr.responseText);

                    }
                };
                xhr.send("articleId=" + articleId + "&status=" + status);
            }
    
    </script>
    <script>
        $(document).ready(function() {
            function viewDetails(articleId) {
                
                $.ajax({
                    url: '../../Backend/get_articles_detail.php',
                    type: 'GET',
                    data: {
                        articleId: articleId
                    },
                    success: function(response) {
                        $('#detailsModalBody').html(response);
                        $('#detailsModal').modal('show');
                        $('#commentTableBody').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

          
            $('.btn-view-details').click(function() {
                var articleId = $(this).data('article-id');
                viewDetails(articleId);
            });
        });


        document.addEventListener("DOMContentLoaded", function() {
            
            $('.btn-comment, .btn-edit-comment').click(function() {
                var articleId = $(this).data('article-id');
                var action = $(this).data('action');
                console.log('Action:', action);
                if (action === 'edit') {
                   
                    var commentId = $(this).data('comment-id'); 
                    var commentContent = $(this).data(
                        'comment-content'); 
                    
                    $('#articleId').val(articleId);
                    $('#commentText').val(commentContent);
                    $('#commentModal .modal-title').text('Edit Comment');
                    $('#submitComment').text('Save'); 
                    $('#commentModal').modal('show'); 
                } else {
                   
                    $('#articleId').val(
                        articleId); 
                    $('#commentText').val(''); 
                    $('#commentModal .modal-title').text('Add Comment');
                    $('#submitComment').text('Submit');
                    $('#commentModal').modal('show'); 
                }
            });

            $('#submitComment').click(function() {
                var formData = $('#commentForm').serialize(); 
                $.ajax({
                    url: '../../Backend/process_comment.php', 
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response,
                        }).then((result) => {
                           
                            if (result.isConfirmed) {
                                $('#commentModal').modal('hide');
                                $('#commentForm')[0].reset();
                            }
                        });
                    },

                });
            });

            
            $('#commentModal').on('hidden.bs.modal', function() {
                $('#commentForm')[0].reset(); 
                $('#commentId').val('');
                $('#articleId').val('');
            });
        });

        function toggleNoClick(status) {
            var elements = document.querySelectorAll('.switch');
            elements.forEach(function(element) {
                if (status === true) {
                    element.classList.add('no-click');
                } else {
                    element.classList.remove('no-click');
                }
            });
        }
    </script>
    </script>

</body>

</html>