<?php
/*подключение к базе данных*/
define('TIMEZONE', 'Europe/Kiev'); date_default_timezone_set(TIMEZONE);
$host = "sql280.main-hosting.eu"; // в 90% случаев это менять не надо
$password = "Assasins2018";
$username = "u630099368_admin22012";
$databasename = "u630099368_cluster_forest";

global $db;
$db = mysqli_connect($host,$username,$password,$databasename);



mysqli_query($db,'SET NAMES utf8');
mysqli_query($db,'SET CHARACTER SET utf8');
mysqli_query($db,'SET COLLATION_CONNECTION="utf8_general_ci"');
setlocale(LC_ALL,"ru_RU.UTF8");