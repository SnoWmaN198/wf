<?php
namespace MicroForce\Controller;

use MicroForce\Engine\EngineSingleton;
use MicroForce\Model\Student;
use MicroForce\Model\Room;

class RoomAccessController
{
    public function roomAccess()
    {
        return EngineSingleton::getEngine()->render(
            'roomaccess.html.php',
            [
                'students' => Student::findAll()
            ]
        );
    }
}
