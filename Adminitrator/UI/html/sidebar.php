<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<style>
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
}
body{
    overflow: hidden;
    font-family: sans-serif; 
    background-color: #387b6a;
    height: 100vh;  
}

.menu{
    height: 100%;
    position: fixed;
    left: 0;
    top: 0;
    width: 250px;
    padding-top: 60px;
    background-color: #212121; 
    transition: 0.5s;
    transform: translateX(-250px);
}
.logo a{
    padding: 15px 25px;
    font-size: 40px;
    text-transform: uppercase;
    color: white;
    /*margin-left: 5px*/
}
.logo a img{
    max-width:140px;
    border-radius: 50%;
    margin-bottom: 10px;
}
ul li{
    border-bottom: 1px solid rgba(255, 255, 255, 0.10);
    transition: 0.3s;
    /*text-align: center;*/
    padding-left: 25px;
}
ul li:hover{
    padding-left: 35px;
    background-color: #445665;
}
ul li a{
    display: block;
    color: #fff;
    padding: 20px;
    text-transform: uppercase;
    font-weight: bold;
}

#open{
    display: none;
}
.open i{
    font-size: 25px;
    cursor: pointer;
    margin-left: 25px;
    margin-top: 25px;
    background-color: #000;
    padding: 15px 15px;
    color: white;
    z-index: 99;
}
#open:checked ~ .menu{
    transition: 0.5s;
    transform: translateX(0);
}
#open:checked ~ .open i{
    transition: 0.5s;
    margin-left: 190px;
    position: absolute;
}


</style>
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
  array("name" => "Management Account", "link" => "approveAccount.php", "allowedRoles" => ["Administrator"]),
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
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav bg-light">
  <ul id="sidebarnav" class="navbar-nav">
    <li class="nav-item nav-small-cap">
      <div class="nav-small-cap-icon"><i class="ti ti-dots fs-4"></i></div>
      <h2 class="text-dark"><?= $userRole ?></h2>
    </li>
    <?php foreach ($menuItems as $menuItem) : ?>
      <?php if (checkUserRole($userRole, $menuItem["allowedRoles"])) : ?>
        <li class="nav-item">
          <a class="nav-link sidebar-link text-dark" href="<?= $menuItem["link"]; ?>" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu"><?= $menuItem["name"]; ?></span>
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