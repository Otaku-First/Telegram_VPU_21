<?php
/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/
require_once("../post/db_connect.php");


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
                        
                      <?php 
                              
       $group_sql = mysqli_query($db,"SELECT * FROM `groups`");
                                  

                                        
                                       

                                        
                                        
                                            ?><br>
                                            <h1>Надсилання сповіщення</h1>
                                            <hr>
                        <div></div>
                        
  <div class="form-group">
    <label for="groupSelect">Виберіть групу</label>
    <select class="form-control" id="groupSelect">
        <?php while($group_arr = mysqli_fetch_array($group_sql)){ ?>
      <option value="<?php echo $group_arr["number"];?>"><?php echo $group_arr["number"]; echo " - ";echo $group_arr["short_name"]; ?></option>

      <?php } ?>
    </select>
  </div>
  
  <div class="form-group">
    <label for="message_text">Текст сповіщення</label>
    <textarea autocomplete="off" class="form-control" id="message_text" rows="3"></textarea>
  </div>  <div class="form-group" style="justify-content: center;display: flex;">
  <button class="btn btn-primary" id="su_send_mess">Надіслати сповіщення</button></div>
                    </div>
                </main>
                 <?php  include '../include/flooter.php';?>
            </div>
        </div>
       <?php  include '../include/script.php';?>
        <script>
            $(document).on("click","#su_send_mess",function (){
                var num_group = $("#groupSelect").val();
                var mess_group =CKEDITOR.instances['message_text'].getData();



                if (mess_group.length==0){
                   
                    notyf.error('Ви не вказали текст сповіщення');
                    return false;
                }
                 $.ajax(
              {
                 type: "GET",
                 url: "https://search-games.online/telega/bot.php",
                 data:{ group_sended:num_group, send_text_to_group:mess_group  },
                 success: function(response) 
                 {notyf.success('Сповіщення було надіслано');
                   console.log("OK")
                 }
              }
              );
            })
            
        </script>
     
        <script>$(document).ready(function() {
 //  $("#groupSelect").chosen(); 
} );</script>
    </body>
</html>
<?php
endif;
?>