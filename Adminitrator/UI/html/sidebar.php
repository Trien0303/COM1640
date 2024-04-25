<head>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>
<style>
  .left-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px; /* Increased width */
    height: 100%;
    background-color: #ffc107; /* Sidebar background color */
    color: #fff; /* Text color */
    box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    transition: width 0.3s ease; /* Smooth transition for width change */
    
}

.sidebar-scroll {
    height: 100%;
    overflow-y: auto;
}

.sidebar-nav {
    padding-top: 20px;
}

.navbar-nav {
    padding-left: 15px;
}

.nav-item {
    padding: 10px 0;
}

.nav-link {
    color: #000; 
    display: block;
    padding: 10px 20px;
    transition: background-color 0.3s;
}


.nav-link:hover {
    background-color: #fff; /* Darker color on hover */
}

.nav-small-cap {
    padding: 10px 0 20px 15px;
    font-weight: bold;
    color: #ccc; /* Lighter color for small caps */
}

.nav-small-cap-icon {
    margin-right: 10px;
}

.text-dark {
    color: #ccc; /* Lighter color for text */
}

.hide-menu {
    margin-left: 10px;
}

</style>
<?php

include_once("../../../connect.php");
include_once("../../../permissions.php");




$userRole = getUserRole($conn);



function checkUserRole($role, $allowedRoles)
{
  return in_array($role, $allowedRoles);
}


$menuItems = array(
  array("name" => "Dashboard", "link" => "index.php", "allowedRoles" => ["Marketing Coordinator", "Marketing Manager", "Administrator,","Guest"]),
  array("name" => "Management Account", "link" => "approveAccount.php", "allowedRoles" => ["Administrator"]),
  array("name" => "Article Manager", "link" => "articles.php", "allowedRoles" => ["Marketing Coordinator", "Administrator"]),
  array("name" => "Marketing Manager", "link" => "marketingManager.php", "allowedRoles" => ["Marketing Coordinator", "Marketing Manager", "Administrator"]),
  array("name" => "Magazine Manager", "link" => "magazine.php", "allowedRoles" => ["Administrator"]),
  array("name" => "Role Manager", "link" => "rolemanager.php", "allowedRoles" => ["Administrator"]),
  array("name" => "Faculty Manager", "link" => "faculty.php", "allowedRoles" => ["Administrator"])
);

?>

<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div class="sidebar-scroll">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav" class="navbar-nav">
        <li class="nav-item nav-small-cap">
          <div class="nav-small-cap-icon"><i class="fas fa-ellipsis-h"></i></div>
          <h2 class="text-dark"><?= $userRole ?></h2>
        </li>
        <?php foreach ($menuItems as $menuItem) : ?>
          <?php if (checkUserRole($userRole, $menuItem["allowedRoles"])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= $menuItem["link"]; ?>" aria-expanded="false">
                
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