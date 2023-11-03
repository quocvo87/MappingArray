<?php

require __DIR__.'/vendor/autoload.php';

use TrueMe\MapArr;

//Element 1
$hello = 'word';
//Element 2
$my_name = 'my name';

/**
 * Element 3
 * sub array -> two demensions
 */
$sub_cal1 = 'calander name 1';
$sub_cal2 = 'calander name 2';
$calander = [$sub_cal1, $sub_cal2];

// Element 4
$today = 'Monday';

// sub array
// Element 5.1.1
$week11 = 'week 1.1';

// Element 5.1.2.1 && Element 5.1.2.2
$week121 = 'week 1.2.1';
$week122 = 'week 1.2.2';
// Element 5.1.2
$week12 = [$week121, $week122];

//Element 5.1
$week1 = [$week11, $week12];

//Element 5.2
$week2 = 'week 2';
//Element 5
$week = [$week1, $week2];

// Element 6
$keyWord = 'key word'; 


$array = [
    'hello' => $hello,
    'myName' => $my_name,
    'calandar' => $calander,
    'today' => $today,
    'week' => $week,
    'keyWord' => $keyWord
];
echo '---------------------ORIGINAL ARRAY-----------------</br>';
var_dump($array);


echo '---------------------CONVERT ARRAY-----------------</br>';
$mArr = new MapArr;
$mArr->camel()->build([$hello, $my_name, $calander, $today, $week, $keyWord]);

var_dump($mArr->get());

