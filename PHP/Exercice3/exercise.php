<?php

$input;
$winner;

$playerACount = 0;
$playerBCount = 0;

foreach($input as $value) {
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