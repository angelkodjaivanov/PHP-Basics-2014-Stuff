<?php
$list = $_GET['list'];
$minPrice = $_GET['minPrice'];
$maxPrice = $_GET['maxPrice'];
$filter  =  $_GET['filter'];
$order = $_GET['order'];

$listPreg = preg_split("/\r?\n/", $list, -1, PREG_SPLIT_NO_EMPTY);

$listOfItem = [];
$NumberOfItem = 1;
foreach ($listPreg as $items) {
    $itemsInfo = preg_split("/\|/", $items);
    $itemsCurrent = new stdClass();
    $itemsCurrent->line = $NumberOfItem;
    $itemsCurrent->name = trim($itemsInfo[0]);
    $itemsCurrent->type = trim($itemsInfo[1]);
    $component = explode(", ", trim($itemsInfo[2]));
    $itemsCurrent->component = $component;
    $itemsCurrent->price = floatval(trim($itemsInfo[3]));
    $NumberOfItem++;
    $listOfItem[] = $itemsCurrent;
}

usort($listOfItem, function($s1, $s2) use ($order) {
    if ($s1->price == $s2->price) {
        return ($s1->line > $s2->line);
    }
    else
    {
    return ($order == "ascending" ^ $s1->price < $s2->price) ;
    }
});

foreach ($listOfItem as $items) {
    if(($items->price >= $minPrice) && ($items->price <= $maxPrice) && (($items->type == $filter ) || ($filter == 'all'))){
        echo '<div class="product" id="product';
        $componentOne  = htmlspecialchars($items->component[0]);
        $componentTwo  = htmlspecialchars($items->component[1]);
        $componentTree  = htmlspecialchars($items->component[2]);
        $items->name = htmlspecialchars($items->name);
        $items->type = htmlspecialchars($items->type);
        $items->line = htmlspecialchars($items->line);
        $items->price = htmlspecialchars(number_format($items->price,2,".",""));
        echo $items->line;
        echo '"><h2>'.$items->name . '</h2><ul><li class="component">' . $componentOne
            . '</li><li class="component">' . $componentTwo
            . '</li><li class="component">' . $componentTree
            . '</li></ul><span class="price">' .$items->price . '</span></div>';
    }

}
