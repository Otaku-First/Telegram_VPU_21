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
        <link href="../assets/css/user_management.css" rel="stylesheet" >
    </head>
    <body class="sb-nav-fixed">
    <?php  include '../include/nav.php';?>
    <div id="layoutSidenav">
        <?php  include '../include/menu.php';?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="container">
                        <div class="table-wrapper">
                            <br>
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <h2>Розклад дзвінків</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $call_schedule_sql = mysqli_query($db,"SELECT * FROM `call_schedule`");
                        $get_call_schedule_arr = mysqli_fetch_array($call_schedule_sql);
                        ?>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3>Пн по Чт</h3>
                                        <textarea rows="8" class="form-control" id="pn_cht"><?php echo $get_call_schedule_arr["pn:cht"]; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3>Пятниця</h3>
                                        <textarea rows="8" class="form-control" id="Friday"><?php echo $get_call_schedule_arr["Friday"]; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="t_set_b">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_call_schedule_b">Зберегти</button>
                                <script>
                                    $(document).on("click","#save_call_schedule_b",function (){
                                        var pn_cht = $("#pn_cht").val();
                                        var Friday = $("#Friday").val();
                                        if (!pn_cht|| !Friday){
                                            alert("Ви не заповнили всі поля");
                                            return false;
                                        }
                                        $.ajax(
                                            {
                                                type: "POST",
                                                url: "../post/save_call_schedule.php",
                                                data:{ pn_cht:pn_cht, Friday:Friday  },
                                                success: function(response)
                                                {
                                                    notyf.success('Розклад дзвінків успішно збережено');
                                                    console.log("OK")
                                                    location.reload();
                                                }
                                            }
                                        );
                                    })
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php  include '../include/flooter.php';?>
        </div>
    </div>
    <?php  include '../include/script.php';?>

    <script>$(document).ready(function() {
            //  $("#groupSelect").chosen();
        } );</script>
    </body>
    </html>
<?php
endif;
?>