<?php
require_once ("../post/db_connect.php")?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="../pages/main.php"><?php echo $config["project_name"]; ?></a><sup style="color: white;left: 155px;top: 11px;position: absolute;"><?php echo $config["project_version"];?></sup>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
               
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Налаштування</a>
                        <a class="dropdown-item" href="logs.php">Логи</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Вихід</a>
                    </div>
                </li>
            </ul>
        </nav>
<?php

?>