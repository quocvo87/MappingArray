<?php

require __DIR__.'/vendor/autoload.php';

use TrueMe\MapArr;

$hello = 'word';
$my_name = 'my name';

// sub array -> two demensions
$sub_cal1 = 'calander name 1';
$sub_cal2 = 'calander name 2';
$calander = [$sub_cal1, $sub_cal2];

$today = 'Monday';


$week11 = 'week 1.1';

$week121 = 'week 1.2.1';
$week122 = 'week 1.2.2';
$week12 = [$week121, $week122];

$week1 = [$week11, $week12];
$week2 = 'week 2';
$week = [$week1, $week2];

$array = [
    'hello' => $hello,
    'myName' => $my_name,
    'calandar' => $calander,
    'today' => $today,
    'week' => $week
];

$keyWord = 'key word'; 
var_dump('Original', $array);

var_dump([$hello, $my_name, $calander, $today, $week, $keyWord]);

echo '------88888888888888888888888888888-</br>';
$mArr = new MapArr;
$mArr->build([$hello, $my_name, $calander, $today, $week, $keyWord]);

var_dump($mArr->get());

