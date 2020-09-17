<?php
require_once("db_connect.php");
require_once("users.php");
$access_token = '935950408:AAEoiKdD6ciM1oCiyPMQedD6idAeJN39fOk';
$api = 'https://api.telegram.org/bot' . $access_token;
$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$callback_query = $output['callback_query'];
$username = $output['message']['chat']['username'];
$username_from = $output['callback_query']['message']['chat']['username'];

$data = $callback_query['data'];
$message_id = ['callback_query']['message']['message_id'];
$chat_id_in = $callback_query['message']['chat']['id'];
$check = $callback_query['message']['reply_markup'];

$dete_send = $output['message']['date'];
$text_send = $output['message']['text'];


$get_groups_sql= mysql_query('SELECT * FROM `groups`',$db);

// створенння клавіатури
$replyMarkup = [
    'keyboard' =>[
        ["Курва"]

    ]

]

;

$keyboard = json_encode($replyMarkup);

//видалення клавіатури

$reply_markup2 = ['remove_keyboard' => true];

$reply_markup2 = json_encode($reply_markup2);

createKeyboard($chat_id, $reply_markup2);

$send_text_to_group = $_GET["send_text_to_group"];
$group_sended = $_GET["group_sended"];
if ($send_text_to_group||$group_sended){

    $send_mess_sql = mysql_query("SELECT `chat_id` FROM `users` WHERE u_group=".$group_sended."",$db);

    while ($send_mess_arr = mysql_fetch_array($send_mess_sql)) {
        foreach ($send_mess_arr as $value) {}
        // var_dump($send_mess_arr);
        sendMessage($send_mess_arr["chat_id"], $send_text_to_group);

    }



}



//sendMessage($chat_id, "Вас додано в групу ".$chat_id);


switch($message) {
    case '/start':

        $mysk = "";
        $sdadass = 0;
// можна юзати url для посилань
        while($get_groups_arr = mysql_fetch_array($get_groups_sql)) {

            $mysk[$sdadass]  = [["text"=>$get_groups_arr["short_name"]."-".$get_groups_arr["number"],"callback_data"=>"set_group".$get_groups_arr["number"]]];
            $sdadass ++;
        }
        $inline_keyboard = $mysk;
        $keyboard=array("inline_keyboard"=>$inline_keyboard);
        $replyMarkup = json_encode($keyboard);
        sendMessage($chat_id, "Вітаємо @".$username." ! Виберіть свою групу", $replyMarkup);

        break;
}

if (strpos($data, 'set_group') !== false)
{
    $u_group=   str_replace("set_group", "", $data);

    switch($data){
        case 'set_group'.$u_group:
            make_user($username_from,$chat_id_in,$u_group);

    }


} else {
    // echo 'Не найдено';
}



save_message($dete_send,$chat_id,$text_send);
//sendMessage(562264443, "курва");