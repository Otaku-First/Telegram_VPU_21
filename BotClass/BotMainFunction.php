<?php
require_once "post/db_connect.php";
require_once "bot.php";


class BotMainFunction
{

    function sendMessage($chat_id, $message, $replyMarkup) {
        file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . '&reply_markup=' . $replyMarkup. "&parse_mode=HTML");
    }
    function createKeyboard($chat_id, $message, $replyMarkup) {

        file_get_contents($GLOBALS['api'] . '/sendMessage?chat_id=' . $chat_id . '&text=' . urlencode($message) . '&reply_markup=' . $replyMarkup);

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
}