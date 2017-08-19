<?php // callback.php
	define("LINE_MESSAGING_API_CHANNEL_SECRET", 'ab1e0cf37c4d7d26083990ec7f1b96bf');
	define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'LmRTYD8yrTt7RIvIsqNjZ1z+jgxHkAkSAS1qNNyjpBMNtst9dCEMIVVrM1qVVkNt3+UW04I+9WNJwZU5qVLvu2TZmslUccJU5vnnkFGEFdA5SaswFb2/qwR+OrjPazyv90uyXImmLuoSmTvCRWOn+wdB04t89/1O/w1cDnyilFU=');

	require __DIR__."/../vendor/autoload.php";

	$bot = new \LINE\LINEBot(
	    new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN),
	    ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]
	);

	$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
	$body = file_get_contents("php://input");

	$events = $bot->parseEventRequest($body, $signature);

	// $image = "failed";

	// try {
	// 	$image = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder(
	// 		"https://resistance-bot-line-indo.herokuapp.com/images/ally-1-en.jpg",
	// 		"https://resistance-bot-line-indo.herokuapp.com/images/ally-1-en.jpg"
	// 		);
	// } catch (Exception $e) {
	//     file_put_contents("php://stderr", "Error new imagebuilder");
	// }

	foreach ($events as $event) {
		// file_put_contents("php://stderr", "Test Gambar | User ID : ".$event->getUserId());

	    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
	        $reply_token = $event->getReplyToken();
	        $text = $event->getText();
	        // $bot->replyMessage($reply_token, $image);
	        $bot->replyMessage($reply_token, "test");
	    }
	}
		echo "OK";