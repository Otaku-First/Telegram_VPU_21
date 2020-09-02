<?php
require_once("db_connect.php");

//$bot_token = $_GET['bot_token'];
// mysql_query('UPDATE `bot` SET token="'.$bot_token.'" WHERE id=1',$db);
//  echo  $bot_token;


 
mysql_query("DELETE FROM `groups` WHERE id = '".$_POST["dell_id"]."' ",$db);
     
 
?>