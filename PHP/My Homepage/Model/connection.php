<?php

try {
    
    $DB = $config['DB'];
    
    $connection = new PDO(
        'mysql:host=' .$DB['host'].';dbname='.$DB['name'],      // DNS => database namespace 
         $DB['user'],                                           // username
         $DB['password']                                        // password
    );  

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    exit();
}