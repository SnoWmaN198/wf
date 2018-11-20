<?php
namespace MicroForce\Controller;

use MicroForce\Engine\EngineSingleton;
use MicroForce\Model\Student;
use MicroForce\Model\Room;

class HomepageController
{

    public function homepage()
    {
        return EngineSingleton::getEngine()->render(
            'homepage.html.php', 
            [
                'students' => Student::findAll()
            ]
        );
    }
}
