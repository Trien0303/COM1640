<?php
// Khởi tạo biến kết nối đến cơ sở dữ liệu
include_once("../../../connect.php");
include_once("../../../permissions.php");




// Sử dụng hàm để lấy vai trò của người dùng
$userRole = getUserRole($conn);


// Hàm để kiểm tra xem mục menu có được hiển thị hay không dựa trên vai trò
function checkUserRole($role, $allowedRoles)
{
  return in_array($role, $allowedRoles);
}

// Các mục menu và vai trò được phép truy cập
$menuItems = array(
  array("name" => "Dashboard", "link" => "index.php", "allowedRoles" => ["Marketing Coordinator", "University Marketing Manager", "Administrator"]),
  array("name" => "Create accounts system", "link" => "register.php", "allowedRoles" => ["Administrator"]),
  array("name" => "Approve accounts", "link" => "approveAccount.php", "allowedRoles" => [ "Administrator"]),
  array("name" => "Article Manager", "link" => "articles.php", "allowedRoles" => ["Marketing Coordinator", "Administrator"]),
  array("name" => "Marketing Manager", "link" => "marketingManager.php", "allowedRoles" => ["University Marketing Manager", "Administrator"]),
  array("name" => "Magazine Manager", "link" => "magazine.php", "allowedRoles" => ["Administrator"]),
  array("name" => "Role Manager", "link" => "rolemanager.php", "allowedRoles" => ["Administrator"]),
  array("name" => "Faculty Manager", "link" => "faculty.php", "allowedRoles" => ["Administrator"])
);

?>

<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="./index.html" class="text-nowrap logo-img">
        <img src="../../assets/images/logos/dark-logo.svg" width="180" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>

    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
      <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <h5>ROLE: <?= $userRole ?></h5>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
        <?php foreach ($menuItems as $menuItem) : ?>
          <?php if (checkUserRole($userRole, $menuItem["allowedRoles"])) : ?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo $menuItem["link"]; ?>" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu"><?php echo $menuItem["name"]; ?></span>
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>