<?php

//ini_set( 'display_errors', '1' );

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
$is_sendMessage = $get_mode_arr["sendMessage"];


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
        $bot_main_function->createKeyboard($chat_id, "\xF0\x9F\x91\x86", $bot_interface->mainKeyboard());
        break;
}

$get_last_mess_sql=  mysqli_query($db,"SELECT * FROM `messages` WHERE chat_id = ".$chat_id." ORDER BY id DESC ");
$get_last_mess_arr = mysqli_fetch_array($get_last_mess_sql);
$last_mes = "";
for($i = 0; $i < 2; $i++){
    $last_mes= $get_last_mess_arr["text"];
}
switch ($message) {
    case "Налаштування \xF0\x9F\x94\xA7":
        $bot_main_function->createKeyboard($chat_id,"Список налаштувань", $bot_interface->settingKeyboard($is_sendMessage));
        break;
    case "Скарги \xF0\x9F\x93\xAE":
        $bot_main_function->sendMessage($chat_id, "Введіть будьласка скаргу:",null);
        break;
    case "Змінити групу \xF0\x9F\x93\x8D":
        $keyboard=array("inline_keyboard"=>$bot_interface->getGroups());
        $replyMarkup = json_encode($keyboard);
        if (strlen($username)==0){
            $username = $first_name;
            $dog="";
        }
        $bot_main_function->sendMessage($chat_id, "Вітаємо ".$dog.$username." ! Виберіть свою групу", $replyMarkup);
        break;
    case "Сповіщення з розкладом \xE2\x9C\x85":
        mysqli_query($db,"UPDATE `users` SET `sendMessage` = 0 WHERE chat_id =" .$chat_id);
        $get_mode_sql= mysqli_query($db,"SELECT * FROM `users` WHERE chat_id=".$chat_id);
        $get_mode_arr = mysqli_fetch_array($get_mode_sql);
        $is_sendMessage = $get_mode_arr["sendMessage"];
        $bot_main_function->createKeyboard($chat_id,"Сповіщення вимкнуто", $bot_interface->settingKeyboard($is_sendMessage));
        break;
    case "Сповіщення з розкладом \xF0\x9F\x9A\xAB":
        mysqli_query($db,"UPDATE `users` SET `sendMessage` = 1 WHERE chat_id =" .$chat_id);
        $get_mode_sql= mysqli_query($db,"SELECT * FROM `users` WHERE chat_id=".$chat_id);
        $get_mode_arr = mysqli_fetch_array($get_mode_sql);
        $is_sendMessage = $get_mode_arr["sendMessage"];
        $bot_main_function->createKeyboard($chat_id,"Сповіщення ввімкнено", $bot_interface->settingKeyboard($is_sendMessage));
        break;
    case "Творці \xF0\x9F\x94\x9E":
        $bot_main_function->sendMessage($chat_id, "Творці бота та системи управління ним:\n@OtakuFirstUA\n@Coll_Otaku",null);
        break;
    case "Назад \xE2\x8F\xAA":
        $bot_main_function->createKeyboard($chat_id, "Головне меню", $bot_interface->mainKeyboard());
        break;
    case "Розклад уроків \xF0\x9F\x93\x9A":
        $get_timetable_sql= mysqli_query($db,'SELECT * FROM `timetable` WHERE for_group='.$get_mode_arr["u_group"]);
        $get_timetable_arr = mysqli_fetch_array($get_timetable_sql);
        $get_timetable = "Розклад уроків на тиждень:\n\xF0\x9F\x94\xB4Понеділок:\n".$get_timetable_arr["Monday"]."\n\xF0\x9F\x94\xB4Вівторок:\n".$get_timetable_arr["Tuesday"]
            ."\n\xF0\x9F\x94\xB4Середа:\n".$get_timetable_arr["Wednesday"]."\n\xF0\x9F\x94\xB4Четвер:\n".$get_timetable_arr["Thursday"]."\n\xF0\x9F\x94\xB4Пятниця:\n".$get_timetable_arr["Friday"];
        $bot_main_function->createKeyboard($chat_id, $get_timetable, null);
        break;
    case "Розклад дзвінків \xF0\x9F\x94\x94":
        $get_call_schedule = mysqli_query($db,'SELECT * FROM `call_schedule`');
        $call_schedule_arr = mysqli_fetch_array($get_call_schedule);
        $call_schedule = "\xF0\x9F\x94\xB4Понеділок по Четвер:\n".$call_schedule_arr["pn:cht"]."\n\xF0\x9F\x94\xB4Пятниця:\n".$call_schedule_arr["Friday"];
        $bot_main_function->createKeyboard($chat_id, $call_schedule, null);
        break;
}

switch($last_mes){
    case "Скарги \xF0\x9F\x93\xAE":
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

            $bot_user->make_user($dog.$username_from,$chat_id_in,$u_group);
            break;
    }
}

$bot_main_function->save_message($dete_send,$chat_id,$text_send);


