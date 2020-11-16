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
    $group = $_GET['group'];

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
                                        <h2>Розклад уроків групи <? echo $group; ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $timetable_sql = mysqli_query($db,"SELECT * FROM `timetable` WHERE for_group = ".$group);
                        $get_timetable_arr = mysqli_fetch_array($timetable_sql);
                        ?>
                        <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>Понеділок</h3>
                                    <textarea rows="8" class="form-control" id="Monday"><?php echo $get_timetable_arr["Monday"]; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>Вівторок</h3>
                                    <textarea rows="8" class="form-control" id="Tuesday"><?php echo $get_timetable_arr["Tuesday"]; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <h3>Середа</h3>
                                    <textarea rows="8" class="form-control" id="Wednesday"><?php echo $get_timetable_arr["Wednesday"]; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>Четвер</h3>
                                    <textarea rows="8" class="form-control" id="Thursday"><?php echo $get_timetable_arr["Thursday"]; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>Пятниця</h3>
                                    <textarea rows="8" class="form-control" id="Friday"><?php echo $get_timetable_arr["Friday"]; ?></textarea>
                                </div>
                            </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" id="dell_timetable_b">Видалити</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="document.location.replace('timetable.php');">Закрити</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" id="save_timetable_b">Зберегти</button>
                                <script>
                                        $(document).on("click","#dell_timetable_b",function (){
                                            $.ajax(
                                                {
                                                    type: "POST",
                                                    url: "../post/dell_timetable.php",
                                                    data:{ for_group:"<?php echo $group; ?>" },
                                                    success: function(response)
                                                    {
                                                        notyf.success('Розклад успішно видалено');
                                                        console.log("OK")
                                                        document.location.replace('timetable.php');
                                                    }
                                                }
                                            );
                                        })
                                        $(document).on("click","#save_timetable_b",function (){
                                            var Monday = $("#Monday").val();
                                            var Tuesday = $("#Tuesday").val();
                                            var Wednesday = $("#Wednesday").val();
                                            var Thursday = $("#Thursday").val();
                                            var Friday = $("#Friday").val();
                                            if (!Monday|| !Tuesday || !Wednesday ||!Thursday || !Friday){
                                                alert("Ви не заповнили всі поля");
                                                return false;
                                            }
                                            $.ajax(
                                                {
                                                    type: "POST",
                                                    url: "../post/update_timetable.php",
                                                    data:{ group:"<?php echo $group; ?>", Monday:Monday, Tuesday:Tuesday, Wednesday:Wednesday, Thursday:Thursday, Friday:Friday  },
                                                    success: function(response)
                                                    {
                                                        notyf.success('Розклад успішно збережено');
                                                        console.log("OK")
                                                        document.location.replace('timetable.php');
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