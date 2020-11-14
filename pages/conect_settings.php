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
                              
 
                                 $get_tok_sql= mysqli_query($db,'SELECT * FROM `bot`  WHERE id=1');
                                       $get_tok_arr = mysqli_fetch_array($get_tok_sql);

                                        
                                        
                                            ?><br>
                                            <h1>Підключення бота</h1>
                                            <hr>
                        <div></div>
                        
  <div class="form-group">
      <a id="conf_hok" href="https://api.telegram.org/bot<? echo $get_tok_arr["token"] ?>/setWebhook?url=https://demo-serv.tk/bot.php">https://api.telegram.org/bot<? echo $get_tok_arr["token"] ?>/setWebhook?url=https://demo-serv.tk/bot.php</a>
      <br>
    <label for="groupSelect">Вставте токен</label>
     <input autocomplete="off" value="<? echo $get_tok_arr["token"] ?>" type="text" class="form-control" id="bot_token">
  </div>
  
 <div class="form-group" style="justify-content: center;display: flex;">
  <button class="btn btn-primary" id="su_send_mess">Підключити бота</button></div>
                    </div>
                </main>
                 <?php  include '../include/flooter.php';?>
            </div>
        </div>
        <?php  include '../include/script.php';?>
        
        <script>
            $(document).on("click","#su_send_mess",function (){
                var bot_token = $("#bot_token").val();
               
               
                if (bot_token.length==0){
                   
                    notyf.error('Ви не вставили токен');
                    return false;
                }
                $("#conf_hok").text("https://api.telegram.org/bot"+bot_token+"/setWebhook?url=https://demo-serv.tk/bot.php");
               $("#conf_hok").attr("href","https://api.telegram.org/bot"+bot_token+"/setWebhook?url=https://demo-serv.tk/bot.php");
                 $.ajax(
              {
                 type: "POST",
                 url: "../post/set_bot_token.php",
                 data:{ bot_token:bot_token },
                 success: function(response) 
                 {
                 notyf.success('Бота підключено');
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