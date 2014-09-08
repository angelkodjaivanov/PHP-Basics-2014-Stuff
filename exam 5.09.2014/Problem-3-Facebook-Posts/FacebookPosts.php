<?php
$text= explode(PHP_EOL,$_GET['text']);

foreach($text as &$minText){
    $parts = explode(';', $minText);
}
$result = "<article><header><span>" . $parts[0] . "</span><time>";
$date = date_parse_from_format("j.F.Y", $parts[1]);

echo $result .= $date;