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

	$image = "failed";
	$img_path = "https://resistance-bot-line-indo.herokuapp.com/images/";
	$img_file = "";

	foreach ($events as $event) {
		file_put_contents("php://stderr", "Test Gambar | User ID : ".$event->getUserId());

	    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
	        $reply_token = $event->getReplyToken();
	        $text = $event->getText();
	        switch ($text) {
	        	case 'ally1':
	        		$img_file = "ally-1-en.jpg";
	        		break;
	        	
	        	case 'ally2':
	        		$img_file = "ally-2-en.jpg";
	        		break;
	        	
	        	case 'ally3':
	        		$img_file = "ally-3-en.jpg";
	        		break;
	        	
	        	case 'ally4':
	        		$img_file = "ally-4-en.jpg";
	        		break;
	        	
	        	case 'ally5':
	        		$img_file = "ally-5-en.jpg";
	        		break;
	        	
	        	case 'ally6':
	        		$img_file = "ally-6-en.jpg";
	        		break;
	        	
	        	case 'axis1':
	        		$img_file = "axis-1-en.jpg";
	        		break;
	        	
	        	case 'axis2':
	        		$img_file = "axis-2-en.jpg";
	        		break;
	        	
	        	case 'axis3':
	        		$img_file = "axis-3-en.jpg";
	        		break;
	        	
	        	case 'axis4':
	        		$img_file = "axis-4-en.jpg";
	        		break;
	        	
	        	case 'leader':
	        		$img_file = "leader-en.jpg";
	        		break;
	        	
	        	case 'mission':
	        		$img_file = "mission-en.jpg";
	        		break;
	        	
	        	case 'fail':
	        		$img_file = "fail-en.jpg";
	        		break;
	        	
	        	case 'succeed':
	        		$img_file = "succeed-en.jpg";
	        		break;
	        	
	        	case 'support':
	        		$img_file = "support-en.jpg";
	        		break;
	        	
	        	case 'reject':
	        		$img_file = "reject-en.jpg";
	        		break;
	        	
	        	default:
	        		# code...
	        		break;
	        }

	        try {
				$image = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder(
					$img_path.$img_file,
					$img_path.$img_file
					);
			} catch (Exception $e) {
			    file_put_contents("php://stderr", "Error new imagebuilder");
			}

	        $bot->replyMessage($reply_token, $image);
	        // $bot->replyText($reply_token, "test");
	    }
	}
		echo "OK";