<?php

// create a function with filepath as parameter
function easterReverse($filePath){
    // get the full file content
    $content = file_get_contents($filePath);
    
    // divide the file content by 2
    $secondPart = substr($content, floor(strlen($content) / 2));
    $firstPart = substr($content, 0, strlen($secondPart) - 1);
    
    // open the file in writing mode
    $file = fopen($filePath, 'r+');
    
    // move the cursor to the first content part 
    fseek($file, strlen($firstPart), SEEK_SET);
    
    // write the reversed second part into the file (strrev)
    fwrite($file, strrev($secondPart), strlen($secondPart));
    
    // close the file
    fclose($file);
}