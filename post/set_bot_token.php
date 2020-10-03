<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

require_once("db_connect.php");
 $bot_token = $_POST['bot_token'];


 
 if(mysqli_query($db,'UPDATE `bot` SET token="'.$bot_token.'" WHERE id=1'))
      echo "OK"; 
     
    else 
      echo "ОШИБКА В ЗАПРОСЕ!";
  
 
?>