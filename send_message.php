<?php 

require_once("db_connect.php");

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
                              
       $group_sql = mysql_query("SELECT * FROM `groups`");
                                  
       $u_name_sql = mysql_query("SELECT `name` FROM `users` WHERE chat_id=".$_GET["u_mess"]."");
                                        
                                        
                                       

                                        
                                        
                                            ?><br>
                                            <h1>Надсилання сповіщення</h1>
                                            <hr>
                        <div></div>
                        
  <div class="form-group">
    <label for="groupSelect">Виберіть групу</label>
    <select class="form-control" id="groupSelect">
        <? while($group_arr = mysql_fetch_array($group_sql)){ ?>
      <option value="<? echo $group_arr["number"];?>"><? echo $group_arr["number"]; echo " - ";echo $group_arr["short_name"]; ?></option>

      <?} ?>
    </select>
  </div>
  
  <div class="form-group">
    <label for="message_text">Текст сповіщення</label>
    <textarea autocomplete="off" class="form-control" id="message_text" rows="3"></textarea>
  </div>  <div class="form-group" style="justify-content: center;display: flex;">
  <button class="btn btn-primary" id="su_send_mess">Надіслати сповіщення</button></div>
                    </div>
                </main>
                 <?php  include 'include/flooter.php';?> 
            </div>
        </div>
       <?php  include 'include/script.php';?> 
        <script>
            $(document).on("click","#su_send_mess",function (){
                var num_group = $("#groupSelect").val();
                var mess_group =$("#message_text").val();
                if (mess_group.length==0){
                    alert("Ви не вказали текст сповіщення");
                    return false;
                }
                 $.ajax(
              {
                 type: "GET",
                 url: "bot.php",
                 data:{ group_sended:num_group, send_text_to_group:mess_group  },
                 success: function(response) 
                 {alert("Надіслано");
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
