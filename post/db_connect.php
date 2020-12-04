<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/


define('TIMEZONE', 'Europe/Kiev'); date_default_timezone_set(TIMEZONE);

$host = "ip";

$password = "pass";

$username = "u";

$databasename = "db_name";

global $db;
$db = mysqli_connect($host,$username,$password,$databasename);



mysqli_query($db,'SET NAMES utf8');

mysqli_query($db,'SET COLLATION_CONNECTION="utf8_general_ci"');
mysqli_set_charset($db, "utf8mb4");
setlocale(LC_ALL,"ru_RU.UTF8");
