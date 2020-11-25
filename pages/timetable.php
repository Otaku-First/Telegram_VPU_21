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
                                    <h2>Розклад уроків</h2>
                                </div>
                                <div class="col-xs-7" style="width: calc(98% - 162px);">
                                    <a href="#" class="btn-m btn-primary"  data-toggle="modal" data-target="#addgroup"><i class="material-icons">&#xE147;</i> <span>Додати розклад</span></a>

                                    <!-- Modal -->
                                    <div class="modal fade animate__animated animate__bounceIn" id="addgroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Додавання розкладу уроків</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Номер групи</label>
                                                        <input type="number" autocomplete="off" class="form-control" id="for_group">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Понеділок</label>
                                                        <textarea autocomplete="off" class="form-control" id="Monday"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Вівторок</label>
                                                        <textarea autocomplete="off" class="form-control" id="Tuesday"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Середа</label>
                                                        <textarea autocomplete="off" class="form-control" id="Wednesday"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Четвер</label>
                                                        <textarea autocomplete="off" class="form-control" id="Thursday"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Пятниця</label>
                                                        <textarea autocomplete="off" class="form-control" id="Friday"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
                                                    <button type="button" class="btn btn-primary" id="add_timetable_b" data-dismiss="modal">Додати</button>
                                                    <script>
                                                        $(document).on("click","#add_timetable_b",function (){
                                                            var group = $("#for_group").val();
                                                            var Monday = $("#Monday").val();
                                                            var Tuesday = $("#Tuesday").val();
                                                            var Wednesday = $("#Wednesday").val();
                                                            var Thursday = $("#Thursday").val();
                                                            var Friday = $("#Friday").val();
                                                            if (!group || !Monday|| !Tuesday || !Wednesday ||!Thursday || !Friday){
                                                                alert("Ви не заповнили всі поля");
                                                                return false;
                                                            }
                                                            $.ajax(
                                                                {
                                                                    type: "POST",
                                                                    url: "../post/add_timetable.php",
                                                                    data:{ group:group, Monday:Monday, Tuesday:Tuesday, Wednesday:Wednesday, Thursday:Thursday, Friday:Friday  },
                                                                    success: function(response)
                                                                    {
                                                                        notyf.success('Розклад успішно додано');
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
                                $timetable_sql = mysqli_query($db,"SELECT for_group FROM `timetable`");
                                while( $get_timetable_arr = mysqli_fetch_array($timetable_sql)){
                                    ?>
                                    <div class="col-xl-3 col-md-6" onclick="document.location.href = 'edit_timetable.php?group=<? echo $get_timetable_arr["for_group"]; ?>';">
                                        <div class="small-box bg-green">
                                            <div class="inner">
                                                <h3><? echo $get_timetable_arr["for_group"]; ?></h3>
                                                <p>Група</p>
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-users"></i>
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
