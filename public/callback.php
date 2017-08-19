<?php // callback.php
	define("LINE_MESSAGING_API_CHANNEL_SECRET", '2769fe5468f35c273fe0e634c244d519');
	define("LINE_MESSAGING_API_CHANNEL_TOKEN", '+VU9EsuQLmIfS9AYpbE5ZTQHag1D3zIVOZe818fWb1GYYk2Pg1MsXQZq72S3McWaIv+2BF5BPeQ9aud8Abwysg7mn/Rus8ASy9ABjH3H8OkyqE1xCtlaBjbnYxjPVPX+1pQk4HdLvlDVJJ5xfnkMngdB04t89/1O/w1cDnyilFU=');

	require __DIR__."/../vendor/autoload.php";

	$bot = new \LINE\LINEBot(
	    new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN),
	    ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]
	);

	$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
	$body = file_get_contents("php://input");

	$events = $bot->parseEventRequest($body, $signature);

	foreach ($events as $event) {
	    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
	        $reply_token = $event->getReplyToken();
	        $text = $event->getText();
	        $bot->replyText($reply_token, "YO! ".$text." lol");
	    }
	}
	file_put_contents("php://stderr", "hello, this is a test!\n");
	echo "OK";