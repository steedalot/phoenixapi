<?php

ini_set('display_errors', 'On');

require "lib/qrlib.php";



$json = file_get_contents('php://input');
$data = json_decode($json);


if (isset($data->type)) {
    
    switch ($data->type) {

        case "qr":

            $text = "";
            $ecc = "Q";
    
            if (isset($data->text)) {

                $text = $data->text;
                
            }

            else {
                $text = "https://www.pgwv.de";
            }


            if (isset($data->ecc)) {

                $ecc = $data->ecc;

            }

            else {

                $ecc = "Q";

            }

            QRcode::png($text, false, $ecc, 4, 2);

            break;

    }

}

else {
    
    $status = 303;
    $answer = "<!DOCTYPE html>\n<html>\n<head>\n<meta http-equiv=\"Refresh\" content=\"0; URL='https://github.com/steedalot/phoenixapi'\">\n</head>\n<body></body>\n</html>";
    http_response_code($status);
    echo $answer;

}

?>