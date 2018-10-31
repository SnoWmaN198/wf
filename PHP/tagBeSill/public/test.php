<?php 
$image = imagecreate(500, 300);

$backgroundColor = imagecolorallocate($image, 95, 148, 255);

$text_color = imagecolorallocate($image, 255, 255, 255);

imagestring($image, 18, 185, 140, 'Hello World!!', $text_color);

$image = imagescale($image, 250, 150);

header('Content-type: image/png');

imagepng($image);