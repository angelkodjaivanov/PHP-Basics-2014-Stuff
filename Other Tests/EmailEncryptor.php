<?php
$recipient = htmlspecialchars($_GET['recipient']);
$subject = htmlspecialchars($_GET['subject']);
$body =htmlspecialchars($_GET['body']);
$key = htmlspecialchars($_GET['key']);

$email = "<p class='recipient'>".$recipient."</p>".
    "<p class='subject'>".$subject."</p>".
    "<p class='message'>".$body."</p>";

//echo $email;
echo encrypt($email , $key);

function encrypt($email , $key){
    $result = '|';
    $keyLen = strlen($key);
    for($i = 0; $i < strlen($email); $i++){
        $result .= dechex(ord($email[$i]) * ord($key[$i % $keyLen]));
        $result .= '|';
    }
    return $result;
}






