<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

require_once("db_connect.php");

//$bot_token = $_GET['bot_token'];../
// mysql_query('UPDATE `bot` SET token="'.$bot_token.'" WHERE id=1',$db);
//  echo  $bot_token;

$check_group = mysqli_query($db,"SELECT * FROM `groups` WHERE number='".$_POST["number"]."'");
//$check_group = mysql_query("SELECT * FROM `groups` WHERE `number`='4600' ",$db);

 $check_group_count = mysqli_num_rows($check_group);

 if($check_group_count!==0){echo "check_group_count_false"; return false;}
 
 if(mysqli_query($db,"INSERT INTO `groups` (number, short_name, full_name,village_elder,manager) VALUES ('{$_POST["number"]}', '{$_POST["short_name"]}', '{$_POST["full_name"]}', '{$_POST["village_elder"]}','{$_POST["manager"]}')"))
      echo ""; 
     
    else 
 echo ""; 
  
 
?>