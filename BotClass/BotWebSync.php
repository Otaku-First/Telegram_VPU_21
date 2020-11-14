<?php
require_once "post/db_connect.php";

class BotWebSync
{
function sendMessageWithWebAdmin($group_sended,$send_text_to_group){


    $send_mess_sql = mysqli_query($db,"SELECT `chat_id` FROM `users` WHERE u_group=".$group_sended);

    while ($send_mess_arr = mysqli_fetch_array($send_mess_sql)) {
        foreach ($send_mess_arr as $value) {}
        // var_dump($send_mess_arr);
        $send_text_to_group = str_replace("<br />", "", $send_text_to_group);
        //  $send_text_to_group =str_replace("</p>", "", $send_text_to_group);
        $send_text_to_group =str_replace("&nbsp;", "", $send_text_to_group);
        sendMessage($send_mess_arr["chat_id"], $send_text_to_group,null);

    }
}
}