<?php
/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/
session_start();
require_once('../post/db_connect.php');
global $db;
?>


<?php

if(isset($_SESSION["session_email"])){
    // вывод "Session is set"; // в целях проверки
    header("Location: main.php");
}

if(isset($_POST["email"])){

    if(!empty($_POST['email']) && !empty($_POST['pass'])) {
        $email=htmlspecialchars($_POST['email']);
        $pass=htmlspecialchars($_POST['pass']);

        $query = mysqli_query($db,"SELECT * FROM `admins` WHERE `email`='".$email."' AND`pass`='".$pass."'");

        $numrows=mysqli_num_rows($query);

        if($numrows!=0)
        {
            while($row=mysqli_fetch_array($query))
            {
                $dbemail=$row['email'];
                $dbpass=$row['pass'];
                $dbrole = $row['role'];
                $dbactive = $row['active'];

            }
            if($email == $dbemail && $pass == $dbpass)
            {
                // старое место расположения
                //  session_start();
                $_SESSION['session_email']=$email;

                /* Перенаправление браузера */
                header("Location: main.php");
            }
        } else {
              $message = "Неправильний пароль або логін";


        }
    } else {
        $message = "Всі поля є обов'язковими";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Авторизація</title>
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Авторизація</h3></div>
                                    <div class="card-body">
                                        <form action="login.php" id="loginform" method="POST" name="loginform">


<label style="width: 100%;color: red;text-align: center;font-size: 16px;">
   <? if(isset($_POST["email"])){ echo $message ; }?>
</label>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" placeholder="Введіть свій email" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Пароль</label>
                                                <input class="form-control py-4" id="inputPassword" name="pass" type="password" placeholder="Введіть свій пароль" />
                                            </div>
                                            <div class="form-group">
<!--                                                <div class="custom-control custom-checkbox">-->
<!--                                                 <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />-->
<!--                                                  <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>-->
<!--                                                </div>-->
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
<!--                                                <a class="small" href="password.html">Forgot Password?</a>-->
                                                <button class="btn btn-primary"  type="submit">Увійти</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Реєстрація</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/scripts.js"></script>
    </body>
</html>
