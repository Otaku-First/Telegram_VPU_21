<?php
require_once("post/db_connect.php");
require_once("bot.php");

$send_mess_sql = mysqli_query($db,"SELECT * FROM `users`");

while ($send_mess_arr = mysqli_fetch_array($send_mess_sql)) {
    foreach ($send_mess_arr as $value) {}

    $get_timetable_sql= mysqli_query($db,'SELECT '.date("l").' FROM `timetable` WHERE for_group='.$send_mess_arr["u_group"]);
    $get_timetable_arr = mysqli_fetch_array($get_timetable_sql);
    $get_timetable = $get_timetable_arr[date("l")];

    if($send_mess_arr["sendMessage"] == 1){
        $bot_main_function->sendMessage($send_mess_arr["chat_id"], $get_timetable,null);
    }

}
