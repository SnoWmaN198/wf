<?php 

namespace MicroForce\Controller;

use Symfony\Component\Templating\PhpEngine;
use MicroForce\Engine\EngineSingleton;

class HomepageController {
    
    public function homepage() 
    {
        return EngineSingleton::getEngine()->render('homepage.html.php');
    }
}
