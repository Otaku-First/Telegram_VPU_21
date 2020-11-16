<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

require_once("db_connect.php");

$group = $_POST['group'];
$Monday = str_ireplace('\'', '‘',$_POST['Monday']);
$Monday = str_ireplace('"','“',$Monday);
$Tuesday = str_ireplace('\'', '‘',$_POST['Tuesday']);
$Tuesday = str_ireplace('"','“',$Tuesday);
$Wednesday = str_ireplace('\'', '‘',$_POST['Wednesday']);
$Wednesday = str_ireplace('"','“',$Wednesday);
$Thursday = str_ireplace('\'', '‘',$_POST['Thursday']);
$Thursday = str_ireplace('"','“',$Thursday);
$Friday = str_ireplace('\'', '‘',$_POST['Friday']);
$Friday = str_ireplace('"','“',$Friday);

$query = "UPDATE `timetable` SET `Monday` = '".$Monday."', `Tuesday` = '".$Tuesday."', `Wednesday` = '".$Wednesday."', `Thursday` = '".$Thursday."', `Friday` = '".$Friday."' WHERE `timetable`.`for_group` LIKE '".$group."'";
$res = mysqli_query($db, $query);

?>