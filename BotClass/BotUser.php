<?php
require_once "post/db_connect.php";

class BotUser

{


    function make_user($name,$chat_id,$u_group){
        global $db;
        $name = mysqli_real_escape_string($db,$name);
        $chat_id = mysqli_real_escape_string($db,$chat_id);
        $u_group = mysqli_real_escape_string($db,$u_group);
        $sel = "SELECT * FROM `users` WHERE chat_id = ".$chat_id;
        $res = mysqli_query($db,$sel);
        $num = mysqli_num_rows($res);
        $get_group_info_sql= mysqli_query($db,"SELECT * FROM `groups` WHERE number=".$u_group);
        $get_group_info_arr = mysqli_fetch_array($get_group_info_sql);

        $sel2 = "SELECT * FROM `messages` WHERE chat_id = ".$chat_id." ORDER BY id DESC ";
        $res2 = mysqli_query($db,$sel2);
        $arrMess = mysqli_fetch_array($res2);
        $last_mes= $arrMess["text"];
        if($last_mes=="Змінити групу"){
            $query = "UPDATE `users` SET u_group = '".$u_group."' WHERE chat_id = ".$chat_id;
            mysqli_query($db,$query);
            sendMessage($chat_id,  $name ." ви змінили групу на ".$get_group_info_arr["short_name"]."-".$u_group, null);
        }else if($num == 0) {
            $query = "insert into `users`(name,chat_id,u_group) values('{$name}','{$chat_id}','{$u_group}')";
            mysqli_query($db,$query);
            sendMessage($chat_id,  $name ." вас додано в групу ".$get_group_info_arr["short_name"]."-".$u_group, null);

        }else {
            $get_user_info_sql= mysqli_query($db,'SELECT * FROM `users` WHERE chat_id='.$chat_id);
            $get_user_info_arr = mysqli_fetch_array($get_user_info_sql);

            $get_group_info_sql= mysqli_query($db,'SELECT * FROM `groups` WHERE number='.$get_user_info_arr["u_group"]);
            $get_group_info_arr = mysqli_fetch_array($get_group_info_sql);
            sendMessage($chat_id, $name." вас не додано в групу ".$get_group_info_arr["short_name"]."-".$u_group. " оскільки ви вже знаходитесь в групі ".$get_group_info_arr["short_name"]."-".$get_user_info_arr["u_group"]."", null);
        }


    }

}