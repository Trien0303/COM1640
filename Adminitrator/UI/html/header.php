<?php
include_once("../../../connect.php");
?>
<body>
    <style>
        .btn-primary {
            background-color: #ffc107; 
            color: #000; 
            padding: 10px 20px; 
            border: none;
            border-radius: 5px; 
            text-decoration: none;
            transition: background-color 0.3s ease; 
        }
    </style>
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <a href="../../../index.php" target="_blank" class="btn btn-primary">Home</a>
            </ul>
            </ul>
        </div>

    </nav>
</header>
</body>