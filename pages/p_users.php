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

                    <?php


                    $get_groups_sql= mysqli_query($db,'SELECT * FROM `admins`');


                    ?><br>

                    <div></div>

                    <div class="container">
                        <div class="table-responsive">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <h2>Користувачі панелі</h2>
                                        </div>
                                        <div class="col-xs-7" style="width: calc(100% - 230px);">
                                            <a href="#" class="btn-m btn-primary"  data-toggle="modal" data-target="#addgroup"><i class="material-icons">&#xE147;</i> <span>Додати групу</span></a>


                                            <!-- Modal -->
                                            <div class="modal fade animate__animated animate__bounceIn" id="addgroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Додавання групи</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Номер групи</label>
                                                                <input type="number" autocomplete="off" class="form-control" id="number">

                                                            </div>
                                                            <div class="form-group">
                                                                <label >Коротка назва</label>
                                                                <input type="text" autocomplete="off" class="form-control" id="short_name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label >Повна назва</label>
                                                                <input type="text" class="form-control" autocomplete="off" id="full_name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label >Староста</label>
                                                                <select class="form-control" autocomplete="off" id="village_elder"><option>1</option></select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label >Керівник</label>
                                                                <select class="form-control" autocomplete="off" id="manager"><option>1</option></select>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
                                                            <button type="button" class="btn btn-primary" id="add_group_b" data-dismiss="modal">Додати</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-hover">
                                    <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>ПІ</th>
                                        <th>Email</th>
                                        <th>Роль</th>
                                        <th>Керівник</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?
                                    while( $get_groups_arr = mysqli_fetch_array($get_groups_sql)){

                                        ?>
                                        <tr data-dell-id="<? echo $get_groups_arr["id"]; ?>">
                                            <td><? echo $get_groups_arr["id"]; ?></td>
                                            <!--<td><a href="#"><img src="/examples/images/avatar/1.jpg" class="avatar" alt="Avatar"> Michael Holz</a></td>-->
                                            <td><? echo $get_groups_arr["full_name"]; ?></td>
                                            <td><? echo $get_groups_arr["email"]; ?></td>

                                            <td><? echo $get_groups_arr["role"]; ?></td>
<!--                                            <td>--><?// echo $get_groups_arr["manager"]; ?><!--</td>-->
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#editgroup<? echo $get_groups_arr["id"]; ?>" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                                <a href="#" class="delete" title="Delete" data-dell="<? echo $get_groups_arr["id"]; ?>" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                            </td>
                                        </tr>



                                        <div class="modal fade animate__animated animate__bounceIn" id="editgroup<? echo $get_groups_arr["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Редагування користувача: <? echo $get_groups_arr["full_name"]; ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>ПІ</label>
                                                            <input type="text" autocomplete="off" value="<? echo $get_groups_arr["full_name"]; ?>" class="form-control" id="edit_number<? echo $get_groups_arr["id"]; ?>">

                                                        </div>
                                                        <div class="form-group">
                                                            <label >Email</label>
                                                            <input type="email"autocomplete="off" value="<? echo $get_groups_arr["email"]; ?>" class="form-control" id="edit_short_name<? echo $get_groups_arr["id"]; ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label >Роль</label>
                                                            <select class="form-control" autocomplete="off" value="<? echo $get_groups_arr["id"]; ?>" id="edit_village_elder<? echo $get_groups_arr["id"]; ?>"></select>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
                                                        <button type="button" class="btn btn-primary" id="edit_group_b<? echo $get_groups_arr["id"]; ?>" data-dismiss="modal">Зберегти</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <script>

                                            $(document).on("click","#edit_group_b<? echo $get_groups_arr["id"]; ?>",function (){
                                                $("#editgroup<? echo $get_groups_arr["id"]; ?>").css('--animate-duration', '1s');
                                                var edit_number = $("#edit_number<? echo $get_groups_arr["id"]; ?>").val();
                                                var edit_short_name =$("#edit_short_name<? echo $get_groups_arr["id"]; ?>").val();
                                                var edit_full_name = $("#edit_full_name<? echo $get_groups_arr["id"]; ?>").val();
                                                var edit_village_elder =$("#edit_village_elder<? echo $get_groups_arr["id"]; ?>").val();
                                                var edit_manager = $("#edit_manager<? echo $get_groups_arr["id"]; ?>").val();
                                                var myi_id = <? echo $get_groups_arr["id"]; ?>;
                                                if (!edit_number || !edit_short_name|| !edit_full_name || !edit_village_elder ||!edit_manager){
                                                    alert("Ви не заповнили всі поля");
                                                    return false;
                                                }
                                                $.ajax(
                                                    {
                                                        type: "POST",
                                                        url: "post/update_group.php",
                                                        data:{ myi_id:myi_id, edit_number:edit_number, edit_short_name:edit_short_name, edit_full_name:edit_full_name,edit_village_elder:edit_village_elder,edit_manager:edit_manager  },
                                                        success: function(response)
                                                        {
                                                            // if(response!=="check_group_count_false"){
                                                            notyf.success('Групу успішно відредаговано');
                                                            // }else{notyf.error('Така група вже є в БД');}






                                                            console.log("OK")
                                                        }
                                                    }
                                                );
                                            })

                                        </script>



                                    <? }?>

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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <script>





        $(document).on("click","#add_group_b",function (){
            var number = $("#number").val();
            var short_name =$("#short_name").val();
            var full_name = $("#full_name").val();
            var village_elder =$("#village_elder").val();
            var manager = $("#manager").val();

            if (!number || !short_name|| !full_name || !village_elder ||!manager){
                alert("Ви не заповнили всі поля");
                return false;
            }
            $.ajax(
                {
                    type: "POST",
                    url: "post/add_group.php",
                    data:{ number:number, short_name:short_name, full_name:full_name,village_elder:village_elder,manager:manager  },
                    success: function(response)
                    {
                        if(response!=="check_group_count_false"){
                            notyf.success('Групу успішно додано');
                        }else{notyf.error('Така група вже є в БД');}






                        console.log("OK")
                    }
                }
            );
        })
            .on("click",'a[data-dell]',function (){


                swal({
                    title: "Ви дійсно хочете видалити цю групу?",
                    text: "Ця дія безповоротна!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    buttons: ["Скасувати", "ОК"],
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            var dell_id = $(this).attr("data-dell");
                            $('tr[data-dell-id="'+dell_id+'"]').remove();
                            $.ajax(
                                {
                                    type: "POST",
                                    url: "post/dell_group.php",
                                    data:{ dell_id:dell_id  },
                                    success: function(response) {

                                        notyf.success('Групу успішно видалено');

                                    }
                                });
                        } else {

                        }
                    });

                return false;
            })

    </script>


    </body>
    </html>
<?php
endif;
?>