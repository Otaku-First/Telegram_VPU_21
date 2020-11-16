<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

require_once("db_connect.php");

$check_group = mysqli_query($db,"SELECT * FROM `timetable` WHERE `for_group` = '".$_POST["group"]."'");

$check_group_count = mysqli_num_rows($check_group);

if($check_group_count!==0){echo "check_group_count_false"; return false;}
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

if(mysqli_query($db,"INSERT INTO `timetable` (for_group, Monday, Tuesday, Wednesday, Thursday, Friday) VALUES ('{$group}', '{$Monday}', '{$Tuesday}', '{$Wednesday}', '{$Thursday}','{$Friday}')"))
    echo "";

else
    echo "";


?>
