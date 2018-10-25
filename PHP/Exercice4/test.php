<?php

$date = new DateTime('first day of current month at midnight');
$lastDate = new DateTime('last day of current month at midnight');

$date -> add(new DateInterval('+1day'));

/*
 * Y = year as 4 digits
 * m = month as 2 digits 
 * d = day as 2 digits
 * 
 * H = hours as 2 digits
 * i = minutes as 2 digits
 * s = seconds as 2 digits
*/
$dateAsString -> format('Y-m-d');