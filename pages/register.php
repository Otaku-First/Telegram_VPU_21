<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

require_once("../post/db_connect.php");

if(isset($_POST["register"])){

    if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $full_name= htmlspecialchars($_POST['full_name']);
        $email=htmlspecialchars($_POST['email']);
        $password=htmlspecialchars($_POST['password']);
        $query=mysqli_query($db,"SELECT * FROM `admins` WHERE full_name='".$email."'");
        $numrows=mysqli_num_rows($query);
        if($numrows==0) {
            $sql="INSERT INTO `admins`
  (email,full_name,pass)
	VALUES('$email','$full_name', '$password')";
            $result=mysqli_query($db,$sql);
            if($result){
                $message = "Профіль успішно зареєстровано. Перейдуть за <a href='login.php' >посиланням</a> щоб увійти в свій профіль";
            } else {
                $message = "Не вдалося додати користувача";
            }
        } else {
            $message = "Користувач з таким Email вже існує";
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
    <title>Реєстрація</title>
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Реєстрація</h3></div>
                            <div class="card-body">
                                <form method="POST"  action="register.php">
                                    <label style="width: 100%;color: red;text-align: center;font-size: 16px;">
                                        <? if(isset($_POST["register"])){ echo $message ; }?>
                                    </label>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Прізвище та І'мя</label>
                                        <input class="form-control py-4"  name="full_name" type="text" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" >Email</label>
                                        <input class="form-control py-4"  type="email"  name="email" />
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" >Пароль</label>
                                                <input class="form-control py-4" type="password"  name="password"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputConfirmPassword">Повторіть пароль</label>
                                                <input class="form-control py-4"  type="password"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4 mb-0"><button name= "register" class="btn btn-primary btn-block" type="submit">Створити профіль</button></div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="login.php">Вхід</a></div>
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
