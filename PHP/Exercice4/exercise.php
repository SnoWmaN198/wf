<?php

// create a function and assume two input parameters year and month
function getAllMondaysOfMonth($year, $month) {
    $monday = [];
    // create a date with year and month 
   $date = DateTime::createFromFormat('Yn', $year.$month);
   // Go to the first day of the month
   $date = new DateTime('first day of ' .$date->format('F Y'));
   // if current day is different than monday, go to the next monday
   $interval = DateInterval::createFromDateString('next monday');
   if ($date->format('N') != 1) {
       $date->add($interval);
   }
   // while the month of the date is the needed month, add the date into an array and go to the next monday
   while($date->format('m') == $month) {
       $monday[] = $date->format('l j, M Y');
       $date->add($interval);
   }
   // return the array
   return $monday;
   
   //var_dump($monday);
}

//getAllMondaysOfMonth(2018,01);