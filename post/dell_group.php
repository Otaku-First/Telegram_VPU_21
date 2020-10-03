<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

require_once("db_connect.php");

//$bot_token = $_GET['bot_token'];
// mysql_query('UPDATE `bot` SET token="'.$bot_token.'" WHERE id=1',$db);
//  echo  $bot_token;


 
mysqli_query($db,"DELETE FROM `groups` WHERE id = '".$_POST["dell_id"]."' ");
     
 
?>