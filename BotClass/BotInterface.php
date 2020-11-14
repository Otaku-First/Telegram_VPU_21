<?php
require_once "post/db_connect.php";
global $db;
class BotInterface
{
function mainKeyboard(){
 $main_keyboard = ['keyboard' =>
[
[ "Налаштування"],
[["text" => "Скарги"],
["text" => "Творці"]]

],'resize_keyboard'=> true];
 $main_keyboard = json_encode($main_keyboard);
 return $main_keyboard;
}
function settingKeyboard(){
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










}

