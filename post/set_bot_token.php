<?php
require_once("db_connect.php");
 $bot_token = $_POST['bot_token'];


 
 if(mysql_query('UPDATE `bot` SET token="'.$bot_token.'" WHERE id=1',$db))
      echo "OK"; 
     
    else 
      echo "ОШИБКА В ЗАПРОСЕ!";
  
 
?>