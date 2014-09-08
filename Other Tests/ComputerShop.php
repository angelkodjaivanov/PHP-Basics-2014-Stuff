<?php
$list = $_GET['list'];
$minPrice = $_GET['minPrice'];
$maxPrice = $_GET['maxPrice'];
$filter  =  $_GET['filter'];
$order = $_GET['order'];

$listPreg = preg_split("/\r?\n/", $text, -1, PREG_SPLIT_NO_EMPTY);
echo $listPreg;