<?php
require_once ("post/db_connect.php");
require_once ("bot.php");

function sendMessage($chat_id, $message, $replyMarkup) {
    file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . '&reply_markup=' . $replyMarkup. "&parse_mode=HTML");
}
function createKeyboard($chat_id, $replyMarkup) {

    file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=%F0%9F%91%86&reply_markup=' . $replyMarkup);
//   /%F0%9F%91%86
//  file_get_contents($GLOBALS['api'] . '/deleteMessage?chat_id=' . $chat_id . '&message_id='.$output['message']["message_id"]);

}

function make_user($name,$chat_id,$u_group){
    global $db;
    $name = mysqli_real_escape_string($db,$name);
    $chat_id = mysqli_real_escape_string($db,$chat_id);
    $u_group = mysqli_real_escape_string($db,$u_group);
    $sel = "SELECT * FROM `users` WHERE chat_id = ".$chat_id."";
    $res = mysqli_query($db,$sel);
    $num = mysqli_num_rows($res);
    $get_group_info_sql= mysqli_query($db,"SELECT * FROM `groups` WHERE number=".$u_group."");
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
        $get_user_info_sql= mysqli_query($db,'SELECT * FROM `users` WHERE chat_id='.$chat_id.'');
        $get_user_info_arr = mysqli_fetch_array($get_user_info_sql);

        $get_group_info_sql= mysqli_query($db,'SELECT * FROM `groups` WHERE number='.$get_user_info_arr["u_group"].'');
        $get_group_info_arr = mysqli_fetch_array($get_group_info_sql);
        sendMessage($chat_id, $name." вас не додано в групу ".$get_group_info_arr["short_name"]."-".$u_group. " оскільки ви вже знаходитесь в групі ".$get_group_info_arr["short_name"]."-".$get_user_info_arr["u_group"]."".$is_update, null);
    }


}

function save_message($date,$chat_id,$text){
    global $db;
    $date = mysqli_real_escape_string($db,$date);
    $chat_id = mysqli_real_escape_string($db,$chat_id);
    $text = mysqli_real_escape_string($db,$text);
    $query = "insert into `messages`(date,chat_id,text) values('{$date}','{$chat_id}','{$text}')";
    if ($text){
        mysqli_query($db,$query);
    }
}

function is_user_set($name){
    global $db;
    $name = mysqli_real_escape_string($db,$name);
    $result = mysqli_query($db,"select * from `users` where name='$name' LIMIT 1");

    if(mysqli_fetch_array($result) !== false) return true;
    return false;
}

// // задание настройки
// function set_udata($name,$data = array()){
//     global $db;
//     $name = mysqli_real_escape_string($name);
// //	$u_group = mysql_real_escape_string($u_group);

//     if(!is_user_set($name)){
//         make_user($name,0); // если каким-то чудом этот пользователь не зарегистрирован в базе
//     }
//     $data = json_encode($data,JSON_UNESCAPED_UNICODE);
//     mysql_query($db,"update `users` SET data_json = '{$data}' WHERE name = '{$name}'"); // обновляем запись в базе
// }

// // считываение настройки
// function get_udata($name){
//     global $db;
//     $res = array();
//     $name = mysqli_real_escape_string($name);
//     $result = mysqli_query($db,"select * from `users` where name='$name'");
//     $arr = mysqli_fetch_assoc($result);
//     if(isset($arr['data_json'])){
//         $res = json_decode($arr['data_json'], true);
//     }

//     return $res;
// }