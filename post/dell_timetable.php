<?php

/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/

require_once("db_connect.php");


mysqli_query($db,"DELETE FROM `timetable` WHERE for_group = ".$_POST['for_group']);

?>