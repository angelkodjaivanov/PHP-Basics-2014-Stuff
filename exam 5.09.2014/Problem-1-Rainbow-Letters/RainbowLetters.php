<?php
$word = $_GET['text'];
$red = $_GET['red'];
$green = $_GET['green'];
$blue = $_GET['blue'];
$nth = $_GET['nth'];

$decHexColor = '';
if(strlen(dechex($red)) < 2){
    $decHexColor .=   "0" . dechex($red);
}
else{
    $decHexColor .=  dechex($red);
}
if(strlen(dechex($green)) < 2){
    $decHexColor .=  "0" . dechex($green);
}
else{
    $decHexColor .=  dechex($green);
}
if(strlen(dechex($blue)) < 2){
    $decHexColor .=   "0" . dechex($blue) ;
}
else{
    $decHexColor .=  dechex($blue);
}

$result = "<p>";
for($i = 0;$i < strlen($word);$i++){
    $x = $i + 1;
    if($i == 0){
        $result .= htmlspecialchars($word[$i]);
    }
    elseif($x % $nth == 0 ){
        $result .= '<span style="color:' . " #" .$decHexColor.'">' . htmlspecialchars($word[$i]) . "</span>";
    }
    elseif($i < strlen($word) - 1){
        $result .= htmlspecialchars($word[$i]);
    }
    elseif($i == strlen($word) - 1){
        $result .= htmlspecialchars($word[$i]);
    }
}
$result .="</p>";
echo ($result);