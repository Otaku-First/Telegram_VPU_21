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
                                    <div class="col-xs-7" style="width: calc(100% - 162px);">
                                        <a href="#" class="btn-m btn-primary"  data-toggle="modal" data-target="#addgroup"><i class="material-icons">&#xE147;</i> <span>Додати розклад дзвінків</span></a>

                                        <!-- Modal -->
                                        <div class="modal fade animate__animated animate__bounceIn" id="addgroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Додавання розкладу дзвінків</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="daySelect">Виберіть день</label>
                                                            <select class="form-control" id="daySelect">
                                                                <option value="Понеділок">Понеділок</option>
                                                                <option value="Вівторок">Вівторок</option>
                                                                <option value="Середу">Середа</option>
                                                                <option value="Четвер">Четвер</option>
                                                                <option value="Пятницю">Пятниця</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Текст</label>
                                                            <textarea autocomplete="off" class="form-control" id="text"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
                                                        <button type="button" class="btn btn-primary" id="add_call_schedule_b" data-dismiss="modal">Додати</button>
                                                        <script>
                                                            $(document).on("click","#add_call_schedule_b",function (){
                                                                var for_day = $("#daySelect").val();
                                                                var text = $("#text").val();
                                                                if (!for_day || !text){
                                                                    alert("Ви не заповнили всі поля");
                                                                    return false;
                                                                }
                                                                $.ajax(
                                                                    {
                                                                        type: "POST",
                                                                        url: "../post/add_call_schedule.php",
                                                                        data:{ for_day:for_day, text:text},
                                                                        success: function(response)
                                                                        {
                                                                            notyf.success('Розклад дзвінків успішно додано');
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $call_schedule_sql = mysqli_query($db,"SELECT * FROM `call_schedule`");
                            while( $get_call_schedule_arr = mysqli_fetch_array($call_schedule_sql)){
                                ?>
                                <div class="col-xl-3 col-md-6">
                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h3><? echo $get_call_schedule_arr["for_day"]; ?></h3>
                                            <textarea rows="8" class="form-control" id="text"><? echo $get_call_schedule_arr["text"]; ?></textarea>
                                        </div>
                                        <div>
                                            fdbf
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php  include '../include/flooter.php';?>
        </div>
    </div>
    <?php  include '../include/script.php';?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>$(document).ready(function() {
            //  $("#groupSelect").chosen();
        } );</script>
    </body>
    </html>
<?php
endif;
?>