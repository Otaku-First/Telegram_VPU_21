<?php

require_once("post/db_connect.php");


session_start();

if (!isset($_SESSION["session_email"])):
    header("location:login.php");
else:


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php  include 'include/head.php';?> 
    </head>
    <body class="sb-nav-fixed">
       <?php  include 'include/nav.php';?> 
        <div id="layoutSidenav">
             <?php  include 'include/menu.php';?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        
                      <?php 
                              
       $mess_sql = mysqli_query($db,"SELECT * FROM `messages` WHERE chat_id=".$_GET["u_mess"]."");
                                  
       $u_name_sql = mysqli_query($db,"SELECT `name` FROM `users` WHERE chat_id=".$_GET["u_mess"]."");
                                        
                                        $u_name_arr = mysqli_fetch_array($u_name_sql);
                                       

                                        
                                        
                                            ?>
                                            <h1></h1>
                        <div></div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Повідомлення коритувача:  <b><?php echo $u_name_arr["name"]; ?></b>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th> 
                                                <th>Чат id</th>
                                                <th>Дата</th>
                                               
                                                <th>Текст</th>
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th> 
                                                <th>Чат id</th>
                                                <th>Дата</th>
                                               
                                                <th>Текст</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php 
                                           while ($mess_arr = mysqli_fetch_array($mess_sql)) {
                                               
                                                foreach ($mess_arr as $value) {}
                                           
                                                //var_dump($mess_arr);
                                             
                                            
                                              
                                              
                                               ?>
                                            
                                            <tr>
                                                <td><?php echo $mess_arr["id"];?></td>
                                                <td><?php echo $mess_arr["chat_id"];?></td>
                                                <td><?php echo date("Y-m-d H:i:s",$mess_arr[1]); ?></td>
                                                
                                                <td><?php echo $mess_arr["text"];?></td>
                                             
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
            <?php  include 'include/flooter.php';?> 
            </div>
        </div>
         <?php  include 'include/script.php';?> 
        <script>$(document).ready(function() {
    $('#dataTable2').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );</script>
    </body>
</html>
<?php
endif;
?>