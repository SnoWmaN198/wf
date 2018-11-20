<?php

use MicroForce\Kernel\Kernel;

require __DIR__ . '/../vendor/autoload.php';

$kernel = new Kernel();

echo $kernel->start();
