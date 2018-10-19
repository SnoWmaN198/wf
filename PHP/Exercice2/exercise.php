<?php
$password = 123456789;
$salt = 'S';

$firstPart = substr($password, 0, floor(strlen($password)/2) + (strlen($password) % 2));   // modulo (%) is used to distinct between even and odd lengths  
$lastPart = substr($password, ceil(strlen($password)/2));

$saltedPassword = $firstPart.$salt.$lastPart;

echo $saltedPassword;
