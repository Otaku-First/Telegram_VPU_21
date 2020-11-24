<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

require_once("db_connect.php");

$pn_cht = str_ireplace('\'', '‘',$_POST['pn_cht']);
$pn_cht = str_ireplace('"','“',$pn_cht);
$Friday = str_ireplace('\'', '‘',$_POST['Friday']);
$Friday = str_ireplace('"','“',$Friday);

$query = "UPDATE `call_schedule` SET `pn:cht` = '".$pn_cht."', `Friday` = '".$Friday."' WHERE id = 1";
$res = mysqli_query($db, $query);
?>
