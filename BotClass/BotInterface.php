<?php
require_once "post/db_connect.php";

class BotInterface
{
    function mainKeyboard(){
        $main_keyboard = ['keyboard' =>
            [
                [ "Налаштування \xF0\x9F\x94\xA7"],
                [["text" => "Скарги \xF0\x9F\x93\xAE" ],
                    ["text" => "Творці \xF0\x9F\x94\x9E"]]

            ],'resize_keyboard'=> true];
        $main_keyboard = json_encode($main_keyboard);
        return $main_keyboard;
    }
    function settingKeyboard($is_sendMessage){
        $is_sendMessage_ico = "";
        if($is_sendMessage==1){
            $is_sendMessage_ico= "\xE2\x9C\x85";
        } else {
            $is_sendMessage_ico= "\xF0\x9F\x9A\xAB";
        }

        $setings_keyboard = [
            'keyboard' =>[
                ["Змінити групу \xF0\x9F\x93\x8D"],

                ["Сповіщення з розкладом ".$is_sendMessage_ico],


                ["Назад \xE2\x8F\xAA"]
            ],
            'resize_keyboard'=> true
        ];
        $setings_keyboard = json_encode($setings_keyboard);
        return $setings_keyboard;

    }

    function getGroups(){
        global $db;
        $get_groups_sql= mysqli_query($db,"SELECT * FROM `groups`");
        $sdadass = 0;
        while($get_groups_arr = mysqli_fetch_array($get_groups_sql)) {

            $mysk[$sdadass]  = [["text"=>$get_groups_arr["short_name"]."-".$get_groups_arr["number"],"callback_data"=>"set_group".$get_groups_arr["number"]]];
            $sdadass ++;
        }
        return $mysk;
    }
    function removeKeyboard(){

        $remove_keyboard = ['remove_keyboard' => true];

        $remove_keyboard = json_encode($remove_keyboard);


    }
    function off_on_send_Keyboard(){
        $setings_keyboard = [
            'keyboard' =>[
                ["Змінити групу"],
                ["Сповіщення з розкладом"]
            ],
            'resize_keyboard'=> true
        ];
        $setings_keyboard = json_encode($setings_keyboard);
        return $setings_keyboard;
    }



}

