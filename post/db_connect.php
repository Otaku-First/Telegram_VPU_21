<?php
/*подключение к базе данных*/
define('TIMEZONE', 'Europe/Kiev'); date_default_timezone_set(TIMEZONE);
$host = "sql280.main-hosting.eu"; // в 90% случаев это менять не надо
$password = "Assasins2018";
$username = "u630099368_admin22012";
$databasename = "u630099368_cluster_forest";

global $db;
$db = @mysql_connect($host,$username,$password) or die("error: Failed_connect_database");

mysql_select_db($databasename, $db) or die("error:Database not selected witch mysql_select_db");

mysql_query('SET NAMES utf8',$db);
mysql_query('SET CHARACTER SET utf8',$db );
mysql_query('SET COLLATION_CONNECTION="utf8_general_ci"',$db ); 
setlocale(LC_ALL,"ru_RU.UTF8");