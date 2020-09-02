<?php
/**
 * revcom_bot
 *
 * @author - Александр Штокман
 */
include('vendor/autoload.php');
use Telegram\Bot\Api;
require_once("db_connect.php");
require_once("users.php");
// дебаг
if(true){
	error_reporting(E_ALL & ~(E_NOTICE | E_USER_NOTICE | E_DEPRECATED));
	ini_set('display_errors', 1);
}

$get_tok_sql= mysql_query('SELECT * FROM `bot`  WHERE id=1',$db); 
                                       $get_tok_arr = mysql_fetch_array($get_tok_sql);

// создаем переменную бота
$token = $get_tok_arr["token"];
$bot = new \TelegramBot\Api\Client($token);

// если бот еще не зарегистрирован - регистируем
if(!file_exists("registered.trigger")){ 
	/**
	 * файл registered.trigger будет создаваться после регистрации бота. 
	 * если этого файла нет значит бот не зарегистрирован 
	 */
	 
	// URl текущей страницы
	$page_url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$result = $bot->setWebhook($page_url);
	if($result){
		file_put_contents("registered.trigger",time()); // создаем файл дабы прекратить повторные регистрации
	} else die("ошибка регистрации");
}

// Команды бота
$bot->command("ibutton", function ($message) use ($bot) {

});

// Обработка кнопок у сообщений
$bot->on(function($update) use ($bot, $callback_loc, $find_command){
	$callback = $update->getCallbackQuery();
	$message = $callback->getMessage();
	$chatId = $message->getChat()->getId();
	$data = $callback->getData();

	if($data == "data_test"){
// 		$bot->answerCallbackQuery( $callback->getId(), "This is Ansver!",true);

	$bot->sendMessage($chatId, "Файно!");
   	make_user($callback->getFrom()->getUsername(),$chatId,46);
       set_udata($callback->getFrom()->getUsername(), null);
		$bot->answerCallbackQuery($callback->getId()); // можно отослать пустое, чтобы просто убрать "часики" на кнопке
	}
	if($data == "data_test2"){
		$bot->sendMessage($chatId, "Файно!");
   	make_user($callback->getFrom()->getUsername(),$chatId,36);
       set_udata($callback->getFrom()->getUsername(), null);
		$bot->answerCallbackQuery($callback->getId()); // можно отослать пустое, чтобы просто убрать "часики" на кнопке
	}

}, function($update){
	$callback = $update->getCallbackQuery();
	if (is_null($callback) || !strlen($callback->getData()))
		return false;
	return true;
});
// пинг. Тестовая
// регистрация юзера
$send_text_to_group = $_GET["send_text_to_group"];
$group_sended = $_GET["group_sended"];
if ($send_text_to_group||$group_sended){
  
	$send_mess_sql = mysql_query("SELECT `chat_id` FROM `users` WHERE u_group=".$group_sended."",$db);

	while ($send_mess_arr = mysql_fetch_array($send_mess_sql)) {
                                                foreach ($send_mess_arr as $value) {}
                                           // var_dump($send_mess_arr);
                 $bot->sendMessage($send_mess_arr["chat_id"], $send_text_to_group);
	    
	}
	

   
}

$bot->on(function($Update) use ($bot){
$message = $Update->getMessage();
	$mtext = $message->getText();
	$cid = $message->getChat()->getId();
//  save_message($Update->getMessage()->getDate(),$Update->getChat()->getId(),$Update->getMessage()->getText());
if ($mtext){
save_message($message->getDate(),$cid,$mtext);
//save_message("2020",56666,"52252  fs ffsdf ");
}
if ($message->getPhoto()){
    save_message($message->getDate(),$cid,"*відправив фото*");
}
    
}, function($message) use ($name){
	return true; // когда тут true - команда проходит
});


$bot->command('rand', function ($message) use ($bot) {
	srand((float) microtime() * 10000000);
$input = array("https://i.pinimg.com/originals/26/20/3a/26203a9deacf6a0fa74566f66a9799ca.jpg", "https://i.pinimg.com/originals/2d/32/eb/2d32eb18ea894362be2d8a83ba8af922.png", "https://www.pngitem.com/pimgs/m/521-5213286_anime-scanimeday-animeday-neko-nekogirl-animegirl-cute-anime.png", "https://img4.goodfon.ru/wallpaper/nbig/5/23/nekopara-neko-cat-bishojo-kawaii-cute-pretty-japanese-asia-3.jpg", "https://pm1.narvii.com/6921/7e490f2969df9819e70872371357372ba76366d2r1-418-695v2_uhq.jpg");
$rand_keys = array_rand($input, 2);

$bot->sendPhoto($message->getChat()->getId(), $input[$rand_keys[0]]);

});

// обязательное. Запуск бота
$bot->command('start', function ($message) use ($bot) {
       

    //	$keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup([[["text" => "Рандом фото"],["text" => "Слава Україні!"], ["text" => "Цицьки!"]]], true, true);
//$keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup([[["text" => "ОПЗ-46"],["text" => "ОПЗ-36"]]]);
//	$bot->sendMessage($message->getChat()->getId(), "Виберіть свю групу:", false, null,null, $keyboard);

	$keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup(
		[
			[
				//['callback_data' => 'data_test', 'text' => 'Answer'],
				['callback_data' => 'data_test', 'text' => 'ОПЗ-46'],
				['callback_data' => 'data_test2', 'text' => 'ОПЗ-36']
		
			]
		]
	);

	$bot->sendMessage($message->getChat()->getId(), "Вітаємо! Виберіть свою групу", false, null,null,$keyboard
	);

});
// $bot->on(function($Update) use ($bot){
// $message = $Update->getMessage();
// 	$mtext = $message->getText();
//         set_udata($message->getFrom()->getUsername(), $data,$u_group); 

// });



// помощ
$bot->command('help', function ($message) use ($bot) {
    $answer = 'Команды:
/ibutton - кнопки в сообщении
/buttons - reply-панель с кнопками
/getdoc - тестовый документ
/help - помощ';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

// передаем картинку
$bot->command('getpic', function ($message) use ($bot) {
	$pic = "http://aftamat4ik.ru/wp-content/uploads/2017/03/photo_2016-12-13_23-21-07.jpg";

    $bot->sendPhoto($message->getChat()->getId(), $pic);
});

// передаем документ
$bot->command('getdoc', function ($message) use ($bot) {
	$document = new \CURLFile('shtirner.txt');

    $bot->sendDocument($message->getChat()->getId(), $document);
});

// Кнопки у сообщений

// обработка инлайнов
$bot->inlineQuery(function ($inlineQuery) use ($bot) {
	mb_internal_encoding("UTF-8");
	$qid = $inlineQuery->getId();
	$text = $inlineQuery->getQuery();
	
	// Это - базовое содержимое сообщения, оно выводится, когда тыкаем на выбранный нами инлайн
	$str = "Что другие?
Свора голодных нищих.
Им все равно...
В этом мире немытом
Душу человеческую
Ухорашивают рублем,
И если преступно здесь быть бандитом,
То не более преступно,
Чем быть королем...
Я слышал, как этот прохвост
Говорил тебе о Гамлете.
Что он в нем смыслит?
<b>Гамлет</b> восстал против лжи,
В которой варился королевский двор.
Но если б теперь он жил,
То был бы бандит и вор.";
	$base = new \TelegramBot\Api\Types\Inline\InputMessageContent\Text($str,"Html");
	
	// Это список инлайнов
	// инлайн для стихотворения
	$msg = new \TelegramBot\Api\Types\Inline\QueryResult\Article("1","С. Есенин","Отрывок из поэмы `Страна негодяев`");
	$msg->setInputMessageContent($base); // указываем, что в ответ к этому сообщению надо показать стихотворение
	
	// инлайн для картинки
	$full = "http://aftamat4ik.ru/wp-content/uploads/2017/05/14277366494961.jpg"; // собственно урл на картинку 
	$thumb = "http://aftamat4ik.ru/wp-content/uploads/2017/05/14277366494961-150x150.jpg"; // и миниятюра
	
	$photo = new \TelegramBot\Api\Types\Inline\QueryResult\Photo("2",$full,$thumb);
	
	// инлайн для музыки
	$url = "http://aftamat4ik.ru/wp-content/uploads/2017/05/mongol-shuudan_-_kozyr-nash-mandat.mp3";
	$mp3 = new \TelegramBot\Api\Types\Inline\QueryResult\Audio("3",$url,"Монгол Шуудан - Козырь наш Мандат!");
	
	// инлайн для видео
	$vurl = "http://aftamat4ik.ru/wp-content/uploads/2017/05/bb.mp4";
	$thumb = "http://aftamat4ik.ru/wp-content/uploads/2017/05/joker_5-150x150.jpg";
	$video = new \TelegramBot\Api\Types\Inline\QueryResult\Video("4",$vurl,$thumb, "video/mp4","коммунальные службы","тут тоже может быть описание");
	
	// отправка
	try{
		$result = $bot->answerInlineQuery( $qid, [$msg,$photo,$mp3,$video],100,false);
	}catch(Exception $e){
		file_put_contents("errdata",print_r($e,true));
	}
});

// Reply-Кнопки
$bot->command("buttons", function ($message) use ($bot) {
	$keyboard = new \TelegramBot\Api\Types\ReplyKeyboardMarkup([[["text" => "Власть советам!"], ["text" => "Сиськи!"]]], true, true);

	$bot->sendMessage($message->getChat()->getId(), "тест", false, null,null, $keyboard);
});

$bot->on(function($Update) use ($bot){
	$message = $Update->getMessage();
	$mtext = $message->getText();
	$cid = $message->getChat()->getId();
	
	if(is_user_set($message->getFrom()->getUsername()) == false){
		make_user($message->getFrom()->getUsername(),$cid);
	}
	
	/*// сохранение тестовых данных
	$data = array( "prevmsg" => $mtext );
	set_udata($message->getFrom()->getUsername(), $data);
	
	// тест получения данных
	$data = get_udata($message->getFrom()->getUsername());
	$bot->sendMessage($message->getChat()->getId(), json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));*/
	
	
	$data = get_udata($message->getFrom()->getUsername()); // получаем массив данных
	if(!isset($data["mode"])){ // если в нем нет режима - значит человек еще не взаимодействовал с этой командой
		$mode = "name"; // поэтому задаем ему действие по дефолту
	}else{
		$mode = $data["mode"];
	}
	
	if($mtext == "/dbact"){
		// по команде /dbact запускаем цепочку
		if($mode == "name"){
			$bot->sendMessage($message->getChat()->getId(), "Добрый день, укажите, пожалуйста, ваше имя");
			$data["mode"] = "aftername";
			//$bot->sendMessage($message->getChat()->getId(), $data);
			set_udata($message->getFrom()->getUsername(), $data); // сохраняем изменения
		}
		
	}
	if($mode == "aftername"){
		// помещаем имя в массив данных
		$data["name"] = $message->getText(); // очевидно, что после запроса имени пользователь отправит следюущей командой свое имя, то есть оно будет в тексте сообщения.
		$bot->sendMessage($message->getChat()->getId(), "Добрый день, укажите ваш сайт");
		$data["mode"] = "website";
		set_udata($message->getFrom()->getUsername(), $data); // сохраняем изменения
	}
	if($mode == "website"){
		$data["website"] = $message->getText(); // очевидно, что после запроса сайта пользователь отправит следюущей командой свой сайт, то есть адрес будет в тексте сообщения.
		$bot->sendMessage($message->getChat()->getId(), "спасибо.");
		$data["mode"] = "done";
		set_udata($message->getFrom()->getUsername(), $data); // сохраняем изменения
	}
	
	if($mode == "done"){
	 
		// если человек уже прошел опрос - выводим ему собранную у него-же информацию
		$bot->sendMessage($message->getChat()->getId(), "Вы уже проходили опрос и указали такие данные:\nИмя - ".$data["name"]."\nсайт - ".$data["website"]);
	}
	
}, function($message) use ($name){
	return true; // когда тут true - команда проходит
});



// Отлов любых сообщений + обрабтка reply-кнопок
$bot->on(function($Update) use ($bot){
	
	/* обработка постов из канала
	$cpost = $Update->getChannelPost();
	if($cpost){
		// текст
		$text = $cpost->getText();
		// фотки
		$photo = $cpost->getPhoto();
		if($photo){
			$photo_id = $photo[0]->getFileId();
			$file = $bot->getFile($photo_id);
			$furl = $bot->getFileUrl().'/'.$file->getFilePath();
			file_put_contents(basename($furl), file_get_contents( $furl ) );
		}
		file_put_contents("lastmsg",$text);
	}*/
	// все что ниже - нахуй не нужно(внашем случае)!
	//file_put_contents("mtext",$bot->getRawBody()); - получение всего json ответа
	$message = $Update->getMessage();
	$mtext = $message->getText();
	$cid = $message->getChat()->getId();
	
	// array of https://github.com/TelegramBot/Api/blob/master/src/Types/PhotoSize.php
	$photos = $message->getPhoto();
	if(!empty($photos)) foreach($photos as $ph){
		$fileId = $ph->getFileId();
		$data = $bot->downloadFile($fileId);
		file_put_contents("file.jpg",$data);
		$bot->sendMessage($message->getChat()->getId(), "Файл загружен");
	}
	if (mb_stripos($mtext, "Рандом фото") !==false){
	    
	    	srand((float) microtime() * 10000000);
$input = array("https://i.pinimg.com/originals/26/20/3a/26203a9deacf6a0fa74566f66a9799ca.jpg", "https://i.pinimg.com/originals/2d/32/eb/2d32eb18ea894362be2d8a83ba8af922.png", "https://www.pngitem.com/pimgs/m/521-5213286_anime-scanimeday-animeday-neko-nekogirl-animegirl-cute-anime.png", "https://img4.goodfon.ru/wallpaper/nbig/5/23/nekopara-neko-cat-bishojo-kawaii-cute-pretty-japanese-asia-3.jpg", "https://pm1.narvii.com/6921/7e490f2969df9819e70872371357372ba76366d2r1-418-695v2_uhq.jpg");
$rand_keys = array_rand($input, 2);

$bot->sendPhoto($message->getChat()->getId(), $input[$rand_keys[0]]);
	    
	}
	if(mb_stripos($mtext,"Цицьки") !== false){
		$pic = "http://aftamat4ik.ru/wp-content/uploads/2017/05/14277366494961.jpg";

		$bot->sendPhoto($message->getChat()->getId(), $pic);
	}
	if(mb_stripos($mtext,"Слава Україні!") !== false){
		$bot->sendMessage($message->getChat()->getId(), "Героям слава!");
	}
}, function($message) use ($name){
	return true; // когда тут true - команда проходит
});

// запускаем обработку
$bot->run();

echo "бот";?>