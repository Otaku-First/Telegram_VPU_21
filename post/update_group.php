<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

require_once("db_connect.php");

echo $_POST["edit_number"];
echo " ";
echo$_POST["edit_short_name"];echo " ";
echo$_POST["edit_full_name"];echo " ";
echo$_POST["edit_village_elder"];echo " ";
echo$_POST["edit_manager"] ;echo " ";
echo$_POST["myi_id"];echo " ";
 if(
mysqli_query($db,"UPDATE `groups` SET number='".$_POST["edit_number"]."', short_name='".$_POST["edit_short_name"]."', full_name='".$_POST["edit_full_name"]."', village_elder='".$_POST["edit_village_elder"]."', manager='".$_POST["edit_manager"]."' WHERE id='".$_POST["myi_id"]."'"))
      echo "ok"; 
     
    else 
 echo "ne ok"; 
  
 
