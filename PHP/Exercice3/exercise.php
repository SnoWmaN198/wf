<?php

$input;
$winner;

$playerACount = 0;
$playerBCount = 0;

foreach($input as $value) {
   /* list ($a, $b) = $value;       // list is used to separate the elements inside the array (same as $value[0], $value[1])
    if ($a < $b){} */               // better execution time than ($value[0], $value[1])  

    if ($value[0] < $value[1]) {
        $playerBCount ++;
    } else if ($value[0] > $value[1]) {
        $playerACount ++;
    }
}

if ($playerACount < $playerBCount) {
    $winner = 'B';
} else if ($playerACount > $playerBCount) {
    $winner = 'A';
}

//echo $winner;