<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

//require_once ("../config/config.php");
/*подключение к базе данных*/
define('TIMEZONE', 'Europe/Kiev'); date_default_timezone_set(TIMEZONE);
//$host = "sql280.main-hosting.eu"; // в 90% случаев это менять не надо
$host = "176.117.191.36"; // в 90% случаев это менять не надо
//$password = "Assasins2018";
$password = "otakupidor";
//$username = "u630099368_admin22012";
$username = "root";
//$databasename = "u630099368_cluster_forest";
$databasename = "telegram_vpu_21";

global $db;
$db = mysqli_connect($host,$username,$password,$databasename);



mysqli_query($db,'SET NAMES utf8');

mysqli_query($db,'SET COLLATION_CONNECTION="utf8_general_ci"');
mysqli_set_charset($db, "utf8mb4");
setlocale(LC_ALL,"ru_RU.UTF8");