<?php

include "config.php";
$header = "Content-Type: application/json;charset=utf-8";

ini_set('display_errors', 'On');

$debug = true;

require "rb.php";
require "Url.php";
require "OpenAi.php";


use Orhanerday\OpenAi\OpenAi;

R::setup('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DATABASE, MYSQL_USER, MYSQL_PASS);
$open_ai = new OpenAi(OPENAI_API_KEY);

$json = file_get_contents('php://input');
$data = json_decode($json);

if (isset($data->action) && isset($data->id)) {
    
    switch ($data->action) {

        case "chat":


            $message2 = R::load("message", $data->id);
            if ((((int)$message2->chat) - 1000000) > 0) {
                $message1 = R::load("message", ((int)$message2->chat) - 1000000);
            }
            else {
                $answer = "Das System konnte diesen Chat nicht finden.";
                $status = 404;
            }

            $messages = [
                [
                    "role" => "system",
                    "content" => $message1->message  
                ],
                [
                    "role" => "system",
                    "content" => $message2->message
                ]
            ];
            
            if ($debug) {
                print("Das Messages Array ohne Nachrichten vom Client:");
                print_r($messages);
            }

            if (isset($data->chat)) {

                foreach ($data->chat as $message) {
                    $messages[] = get_object_vars($message);
                }
            
                if ($debug) {
                    print("Das Messages Array mit Nachrichten vom Client:");
                    print_r($messages);
                }
            }

            $chat = $open_ai->chat([
                "model" => "gpt-3.5-turbo-16k",
                "messages" => $messages
            ]);

            if ($debug) {
                print_r($chat);
            }

            $reply_openai = json_decode($chat);

            $json_reply = [
                "message" => $reply_openai->choices[0]->message->content,
                "finish_reason" => $reply_openai->choices[0]->finish_reason,
                "tokens" => $reply_openai->usage->prompt_tokens,
                "object" => $message2->user,
                "role" => $message1->user
            ];

            $answer = json_encode($json_reply);
            $status = 200;


            

    }



}

else {
    
    $status = 303;
    $answer = "<!DOCTYPE html>\n<html>\n<head>\n<meta http-equiv=\"Refresh\" content=\"0; URL='https://github.com/steedalot/phoenixapi'\">\n</head>\n<body></body>\n</html>";


}

http_response_code($status);
echo $answer;

?>