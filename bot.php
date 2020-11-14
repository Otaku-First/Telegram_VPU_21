<?php
ini_set( 'display_errors', '1' );
require_once("post/db_connect.php");
require_once("users.php");
// Connect Classes >
require_once "BotClass/BotUser.php";
require_once "BotClass/BotInterface.php";
require_once "BotClass/BotWebSync.php";
require_once "BotClass/BotMainFunction.php";
$bot_user = new BotUser();
$bot_interface = new BotInterface();
$bot_web_sync = new BotWebSync();
$bot_main_function = new BotMainFunction();
// Connect Classes />
global $db;
$access_token = '935950408:AAEoiKdD6ciM1oCiyPMQedD6idAeJN39fOk';
$api = 'https://api.telegram.org/bot' . $access_token;
$file_get_contents = file_get_contents("php://input");
$output = json_decode($file_get_contents, TRUE);
$chat_id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$message_id = $output['message']["message_id"];
$callback_query = $output['callback_query'];
$username = $output['message']['chat']['username'];
$username_from = $output['callback_query']['message']['chat']['username'];
$first_name = $output['message']['chat']['first_name'];
$first_name_from = $output['callback_query']['message']['chat']['first_name'];
$replace_data = $callback_query['data'];
$data = $callback_query['data'];
$message_id = ['callback_query']['message']['message_id'];
$chat_id_in = $callback_query['message']['chat']['id'];
$check = $callback_query['message']['reply_markup'];
$dete_send = $output['message']['date'];
$text_send = $output['message']['text'];
$dog = "@";

//$get_groups_sql= mysqli_query($db,"SELECT * FROM `groups`");
$get_mode_sql= mysqli_query($db,"SELECT * FROM `users` WHERE chat_id=".$chat_id);
$get_mode_arr = mysqli_fetch_array($get_mode_sql);



if ($_GET["group_sended"]||$_GET["send_text_to_group"]){

$bot_web_sync->sendMessageWithWebAdmin($_GET["group_sended"],$_GET["send_text_to_group"]);
}

switch($message) {
    case '/start':

        $keyboard=array("inline_keyboard"=>$bot_interface->getGroups());
        $replyMarkup = json_encode($keyboard);
        if (strlen($username)==0){
            $username = $first_name;
            $dog="";
        }

        $bot_main_function->sendMessage($chat_id, "Вітаємо ".$dog.$username." ! Виберіть свою групу", $replyMarkup);
        $bot_main_function->createKeyboard($chat_id, $bot_interface->mainKeyboard());
        break;
}

$get_last_mess_sql=  mysqli_query($db,"SELECT * FROM `messages` WHERE chat_id = ".$chat_id." ORDER BY id DESC ");
$get_last_mess_arr = mysqli_fetch_array($get_last_mess_sql);
$last_mes = "";
for($i = 0; $i < 2; $i++){
    $last_mes= $get_last_mess_arr["text"];
}
switch ($message) {
    case "Налаштування":
        $bot_main_function->createKeyboard($chat_id, $bot_interface->settingKeyboard());
        break;
    case "Скарги":
        $bot_main_function->sendMessage($chat_id, "Введіть будьласка скаргу:",null);
        break;
    case "Змінити групу":
        $keyboard=array("inline_keyboard"=>$bot_interface->getGroups());
        $replyMarkup = json_encode($keyboard);
        if (strlen($username)==0){
            $username = $first_name;
            $dog="";
        }

        $bot_main_function->sendMessage($chat_id, "Вітаємо ".$dog.$username." ! Виберіть свою групу", $replyMarkup);
        $bot_main_function->createKeyboard($chat_id, $bot_interface->mainKeyboard());
        break;
    case "Сповіщення з розкладом":

        break;
    case "Творці":
        $bot_main_function->sendMessage($chat_id, "Творці бота та системи управління ним:\n@OtakuFirstUA\n@Coll_Otaku",null);
        break;
}

switch($last_mes){
    case "Скарги":
        mysqli_query($db,"UPDATE `users` SET `mode`='".$message."' WHERE chat_id =" .$chat_id);
        $get_user_mode_sql=  mysqli_query($db,"SELECT * FROM `users` WHERE chat_id = ".$chat_id);
        $get_user_mode_arr = mysqli_fetch_array($get_user_mode_sql);
        $date_r = date_create();
        $report_t =$get_user_mode_arr['mode'];
        $report_d = date_timestamp_get($date_r);
        mysqli_query($db,"INSERT INTO `report` (chat_id, text, input_date) VALUES ('{$chat_id}','{$report_t}','{$report_d}') ");
        $bot_main_function->sendMessage($chat_id, "Вашу скаргу було надіслано",null);
        mysqli_query($db,"UPDATE `users` SET `mode`='0' WHERE chat_id =" .$chat_id);
        break;

}

if (strpos($replace_data, 'set_group') !== false)
{
    $u_group=   str_replace("set_group", "", $replace_data);

    switch($replace_data){
        case 'set_group'.$u_group:
            if (strlen($username_from)==0){
                $username_from = $first_name_from;
                $dog = "";

            }
            $is_update = true;
           // make_user($dog.$username_from,$chat_id_in,$u_group);
            $bot_user->make_user($dog.$username_from,$chat_id_in,$u_group);
            break;
    }
}

$bot_main_function->save_message($dete_send,$chat_id,$text_send);

