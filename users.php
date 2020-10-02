<?php
/** модель работы с пользователями **/
function sendMessage($chat_id, $message, $replyMarkup) {
    file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . '&reply_markup=' . $replyMarkup);
}
function createKeyboard($chat_id, $replyMarkup) {
    file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&reply_markup=' . $replyMarkup);
}

function make_user($name,$chat_id,$u_group){
    global $db;
    $name = mysqli_real_escape_string($name);
    $chat_id = mysqli_real_escape_string($chat_id);
    $u_group = mysqli_real_escape_string($u_group);
    $sel = "SELECT * FROM `users` WHERE chat_id = ".$chat_id."";
    $res = mysqli_query($db,$sel);
    $num = mysqli_num_rows($res);

    $get_group_info_sql= mysqli_query($db,'SELECT * FROM `groups` WHERE number='.$u_group.'');
    $get_group_info_arr = mysqli_fetch_array($get_group_info_sql);

    if($num == 0) {
        $query = "insert into `users`(name,chat_id,u_group) values('{$name}','{$chat_id}','{$u_group}')";
        mysqli_query($db,$query) or die("пользователя создать не удалось");
        sendMessage($chat_id, "@". $username_from ." вас додано в групу ".$get_group_info_arr["short_name"]."-".$u_group);

    }else {
        $get_user_info_sql= mysqli_query($db,'SELECT * FROM `users` WHERE chat_id='.$chat_id.'');
        $get_user_info_arr = mysqli_fetch_array($get_user_info_sql);

        $get_group_info_sql= mysqli_query($db,'SELECT * FROM `groups` WHERE number='.$get_user_info_arr["u_group"].'');
        $get_group_info_arr = mysqli_fetch_array($get_group_info_sql);
        sendMessage($chat_id, "@".$name." вас не додано в групу ".$get_group_info_arr["short_name"]."-".$u_group. " оскільки ви вже знаходитесь в групі ".$get_group_info_arr["short_name"]."-".$get_user_info_arr["u_group"]);
    }


}

function save_message($date,$chat_id,$text){
    global $db;
    $date = mysqli_real_escape_string($date);
    $chat_id = mysqli_real_escape_string($chat_id);
    $text = mysqli_real_escape_string($text);
    $query = "insert into `messages`(date,chat_id,text) values('{$date}','{$chat_id}','{$text}')";
    mysqli_query($query,$db);
}

function is_user_set($name){
    global $db;
    $name = mysqli_real_escape_string($name);
    $result = mysqli_query($db,"select * from `users` where name='$name' LIMIT 1");

    if(mysqli_fetch_array($result) !== false) return true;
    return false;
}

// задание настройки
function set_udata($name,$data = array()){
    global $db;
    $name = mysqli_real_escape_string($name);
//	$u_group = mysql_real_escape_string($u_group);

    if(!is_user_set($name)){
        make_user($name,0); // если каким-то чудом этот пользователь не зарегистрирован в базе
    }
    $data = json_encode($data,JSON_UNESCAPED_UNICODE);
    mysql_query("update `users` SET data_json = '{$data}' WHERE name = '{$name}'",$db); // обновляем запись в базе
}

// считываение настройки
function get_udata($name){
    global $db;
    $res = array();
    $name = mysql_real_escape_string($name);
    $result = mysqli_query($db,"select * from `users` where name='$name'");
    $arr = mysqli_fetch_assoc($result);
    if(isset($arr['data_json'])){
        $res = json_decode($arr['data_json'], true);
    }

    return $res;
}