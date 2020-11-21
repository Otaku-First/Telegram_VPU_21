<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

require_once("db_connect.php");

$for_day = str_ireplace('\'', '‘',$_POST['for_day']);
$for_day = str_ireplace('"','“',$for_day);
$text = str_ireplace('\'', '‘',$_POST['text']);
$text = str_ireplace('"','“',$text);

if(mysqli_query($db,"INSERT INTO `call_schedule` (for_day, text) VALUES ('{$for_day}', '{$text}')"))
    echo "";

else
    echo "";


?>
