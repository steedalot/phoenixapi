<?php

ini_set('display_errors', 'On');

$json = file_get_contents('php://input');
$data = json_decode($json);

if (isset($data->prompt)) {



}

else {
    
    $status = 303;
    $answer = "<!DOCTYPE html>\n<html>\n<head>\n<meta http-equiv=\"Refresh\" content=\"0; URL='https://github.com/steedalot/phoenixapi'\">\n</head>\n<body></body>\n</html>";
    http_response_code($status);
    echo $answer;

}

?>