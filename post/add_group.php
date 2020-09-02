<?php
require_once("db_connect.php");

//$bot_token = $_GET['bot_token'];
// mysql_query('UPDATE `bot` SET token="'.$bot_token.'" WHERE id=1',$db);
//  echo  $bot_token;

$check_group = mysql_query("SELECT * FROM `groups` WHERE number='".$_POST["number"]."'",$db);
//$check_group = mysql_query("SELECT * FROM `groups` WHERE `number`='4600' ",$db);

 $check_group_count = mysql_num_rows($check_group);

 if($check_group_count!==0){echo "check_group_count_false"; return false;}
 
 if(mysql_query("INSERT INTO `groups` (number, short_name, full_name,village_elder,manager) VALUES ('{$_POST["number"]}', '{$_POST["short_name"]}', '{$_POST["full_name"]}', '{$_POST["village_elder"]}','{$_POST["manager"]}')",$db))
      echo ""; 
     
    else 
 echo ""; 
  
 
?>