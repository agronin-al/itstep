<?php
$onlinerURL = "http://catalog.onliner.by/mobile/apple/apple_iphone5s16/prices?region=minsk&currency=byr";
$data = file_get_contents("$onlinerURL");
$matches =[];
$prices = preg_match_all("|(<p class=\"price price-primary\"><a href=\")(.*)(\">)(.*)(&nbsp)|",$data, $matches,PREG_SET_ORDER);
foreach($matches as $value){
    echo "Цена на Iphone 5s в магазине $value[2] составляет $value[4] рублей </br>";
}



