<?php
$text= explode(PHP_EOL,$_GET['text']);

foreach($text as &$minText){
    $parts = explode(';', $minText);
}
$result = "<article><header><span>" . $parts[0] . "</span><time>";
    $date = explode("-", $parts[1]);
    $date[2] = date("F");

echo $result .= $parts[1];