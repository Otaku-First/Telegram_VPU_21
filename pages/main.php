<?php
/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/
require_once("../post/db_connect.php");
//require_once ("rb/rb.php");
//R::setup('mysql:host=sql280.main-hosting.eu;dbname=u630099368_cluster_forest',
//    'u630099368_admin22012','Assasins2018');
//


session_start();

if (!isset($_SESSION["session_email"])):
    header("location:login.php");
else:


?>
<!DOCTYPE html>
<html lang="en">
    <head>
       <?php  include '../include/head.php';?>
    </head>
    <body class="sb-nav-fixed">
       <?php  include '../include/nav.php';?>
        <div id="layoutSidenav">
             <?php  include '../include/menu.php';?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Головна</h1>
                        <!--<ol class="breadcrumb mb-4">-->
                        <!--    <li class="breadcrumb-item active">Dashboard</li>-->
                        <!--</ol>-->
                        <hr>
                        
                        <?php
                    
 $count_users_sql = mysqli_query($db,"SELECT * FROM `users`");
 $count_report_sql = mysqli_query($db,"SELECT * FROM `report` WHERE view=0");
                        
                        ?>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo  mysqli_num_rows($count_users_sql); ?></h3>
                <p>Користувачів бота</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                               <div class="small-box bg-green">
            <div class="inner">
                <h3>NaN</h3>
                <p>Керівників груп</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
                            </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="small-box bg-yellow">
            <div class="inner">
                 <h3>NaN</h3>
                <p>Старост груп</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
                            </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <a href="reporst.php" style="text-decoration: none;"><div class="small-box bg-red">
            <div class="inner">
                <h3><?php echo  mysqli_num_rows($count_report_sql); ?></h3>
                <p>Скарг</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div></div></a>
                            </div></div>
                        
                        <!--<div class="row">-->
                        <!--    <div class="col-xl-6">-->
                        <!--        <div class="card mb-4">-->
                        <!--            <div class="card-header">-->
                        <!--                <i class="fas fa-chart-area mr-1"></i>-->
                        <!--                Area Chart Example-->
                        <!--            </div>-->
                        <!--            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-xl-6">-->
                        <!--        <div class="card mb-4">-->
                        <!--            <div class="card-header">-->
                        <!--                <i class="fas fa-chart-bar mr-1"></i>-->
                        <!--                Bar Chart Example-->
                        <!--            </div>-->
                        <!--            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Користувачі бота  <?php
                              
                                          $users_sql = mysqli_query($db,"SELECT * FROM `users`");


//                                $users = R::findAll('users');
//                                       print_r($users);
                                       

                                        
                                        
                                            ?>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Нік</th>
                                                <th>Чат id</th>
                                                <th>Група</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Нік</th>
                                                <th>Чат id</th>
                                                 <th>Група</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                           while ($users_arr = mysqli_fetch_array($users_sql)) {
                                                foreach ($users_arr as $value) {}
                                               // var_dump($users_arr);
                                             
                                             
                                              
                                              
                                               ?>
                                            
                                            <tr>
                                                <td><?php echo $users_arr["id"];?></td>
                                                <td><a target="_blank" href="messages.php?u_mess=<?php echo $users_arr["chat_id"];?>"><?php echo $users_arr[1];?></a></td>
                                                <td><?php echo $users_arr["chat_id"];?></td>
                                           <td><?php echo $users_arr["u_group"];?></td>
                                             
                                            </tr>
                                         <?php  }
                                           ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php  include '../include/flooter.php';?>
            </div>
        </div>
        <?php  include '../include/script.php';?>
    </body>
</html>
<?php
endif;
    ?>