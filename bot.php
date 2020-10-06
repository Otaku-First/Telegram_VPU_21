<?php
require("post/db_connect.php");
require("users.php");
global $db;
$access_token = '935950408:AAEoiKdD6ciM1oCiyPMQedD6idAeJN39fOk';
$api = 'https://api.telegram.org/bot' . $access_token;
$output = json_decode(file_get_contents('php://input'), TRUE);
$chat_id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$callback_query = $output['callback_query'];
$username = $output['message']['chat']['username'];
$username_from = $output['callback_query']['message']['chat']['username'];
$first_name = $output['message']['chat']['first_name'];
$first_name_from = $output['callback_query']['message']['chat']['first_name'];
$data = $callback_query['data'];
$message_id = ['callback_query']['message']['message_id'];
$chat_id_in = $callback_query['message']['chat']['id'];
$check = $callback_query['message']['reply_markup'];

$dete_send = $output['message']['date'];
$text_send = $output['message']['text'];
$dog = "@";

$get_groups_sql= mysql_query('SELECT * FROM `groups`');


//видалення клавіатури


//sendMessage(562264443, " 1  ".$output['message']['chat']['first_name']);
$send_text_to_group = $_GET["send_text_to_group"];
$group_sended = $_GET["group_sended"];
if ($send_text_to_group||$group_sended){

    $send_mess_sql = mysql_query("SELECT `chat_id` FROM `users` WHERE u_group=".$group_sended."");

    while ($send_mess_arr = mysql_fetch_array($send_mess_sql)) {
        foreach ($send_mess_arr as $value) {}
        // var_dump($send_mess_arr);
        $send_text_to_group = str_replace("<br />", "", $send_text_to_group);
        //  $send_text_to_group =str_replace("</p>", "", $send_text_to_group);
        $send_text_to_group =str_replace("&nbsp;", "", $send_text_to_group);
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
        if (strlen($username)==0){
            $username = $first_name;
            $dog="";
        }

        sendMessage($chat_id, "Вітаємо ".$dog.$username." ! Виберіть свою групу", $replyMarkup);

        // створенння клавіатури
        $main_keyboard = [
            'keyboard' =>[
                ["Налаштування"],
                ["Скарги"]
            ],
            'resize_keyboard'=> true

        ];

        $main_keyboard = json_encode($main_keyboard);

        $reply_markup2 = ['remove_keyboard' => true];

        $reply_markup2 = json_encode($reply_markup2);
        createKeyboard($chat_id, $main_keyboard);




        break;
}
switch ($data) {
    case "Налаштування":
        sendMessage($chat_id_in, "sadasd" );
        break;


}



if (strpos($data, 'set_group') !== false)
{
    $u_group=   str_replace("set_group", "", $data);

    switch($data){
        case 'set_group'.$u_group:
            if (strlen($username_from)==0){
                $username_from = $first_name_from;
                $dog = "";
            }
            make_user($dog.$username_from,$chat_id_in,$u_group);


    }


} else {
    // echo 'Не найдено';
}



save_message($dete_send,$chat_id,$text_send);
// sendMessage(562264443, "курва");
echo "ok";