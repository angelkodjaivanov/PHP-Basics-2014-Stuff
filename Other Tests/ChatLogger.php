<?php
$currentDate = $_GET['currentDate'];
$messages = explode(PHP_EOL,$_GET['messages']);

$sorted = [];
foreach($messages as &$line){
    $parts = explode(' / ', $line);
    $sorted[$parts[1]] = $parts[0];
}
ksort($sorted);
foreach($sorted as &$messages){
    echo "<div>" . htmlspecialchars($messages) . "</div>" . "\n";
}
$lastTime = array_keys($sorted)[count($sorted)-1];
$d1 = date_parse_from_format("d-m-Y H:i:s",$lastTime);
$d2 = date_parse_from_format("d-m-Y H:i:s",$currentDate);

if($d1['year'] == $d2['year'] &&
    $d1['month'] == $d2['month'] &&
    $d1['day'] == $d2['day'] &&
    $d1['hour'] == $d2['hour'] &&
    ($d1['minute'] == $d2['minute']||
        $d1['minute']+1 == $d2['minute'] &&
        $d1['second'] > $d2['second'])){
    echo "<p>Last active: <time>a few moments ago</time></p>";
}
elseif($d1['year'] == $d2['year'] &&
    $d1['month'] == $d2['month'] &&
    $d1['day'] == $d2['day'] &&
    ($d1['hour'] == $d2['hour'] ||
        $d1['hour']+1 == $d2['hour'] &&
        $d1['minute'] > $d2['minute']||
        $d1['hour']+1 == $d2['hour'] &&
        $d1['minute'] == $d2['minute'] &&
        $d1['second'] > $d2['second'])){
    echo "<p>Last active: <time>". ($d2['minutes'] + 60 - $d1['minutes'] )%60  ." minute(s) ago</time></p>";
}
elseif($d1['year'] == $d2['year'] &&
    $d1['month'] == $d2['month'] &&
    $d1['day'] == $d2['day']    ){
    $d1s = $d1['hour'] * 3600 + $d1['minute'] * 60 + $d1['second'];
    $d2s = $d2['hour'] * 3600 + $d2['minute'] * 60 + $d2['second'];
    echo "<p>Last active: <time>". ($d2s - $d1s )/3600  ." hour(s) ago</time></p>";
}
elseif(($d1['year'] == $d2['year'] &&
        $d1['month'] == $d2['month'] &&
        $d1['day']+1 == $d2['day']) ||
    ($d1['year'] == $d2['year'] &&
        $d1['month']+1 == $d2['month'] &&
        $d1['day'] == cal_days_in_month(CAL_GREGORIAN, $d1['month'], $d1['year']) && $d2['day'] == 1) ||
    ($d1['year']+1 == $d2['year'] &&
        $d1['month'] == 12 && $d2['month'] == 1 &&  $d1['day'] == 31 && $d2['day'] == 1 )){

    echo "<p>Last active: <time>yesterday</time></p>";
}
else{
    echo "<p>Last active: <time>". explode(" ",$lastTime)[0] ."</time></p>";
}