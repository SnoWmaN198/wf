<?php

// require_once 'Animal/cat.php';
// require_once 'Animal/dog.php';

spl_autoload_register(function($namespace) {                                // is used instead of require_once for every single file, will look for the file first and if found will require it
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
    $expectedFileName = __DIR__ . DIRECTORY_SEPARATOR . $path . '.php';
    
    if (file_exists($expectedFileName)) {
        require_once $expectedFileName;
    }
});                                                                         // spl_autoload_register can have an anonymus function as parameter (no need to define a function and later call it)

use Animal\Dog;
use Animal\Cat;
use Animal\Animal;

$dog = new Dog('Benfica', 'Fabio', 'red');
$cat = new Cat('Benfica', 'Filipe', 'darkred');

echo sprintf(
    'The dog says %s when the cat says %s',
    $dog->play(),
    $cat->eat()
);

function trySomething(Animal $animal) {
    $animal->saySomething();
}
