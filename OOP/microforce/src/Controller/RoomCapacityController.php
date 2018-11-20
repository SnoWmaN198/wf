<?php
namespace MicroForce\Controller;

use MicroForce\Model\Room;
use MicroForce\Engine\EngineSingleton;

class RoomCapacityController
{
    public function RoomCapacity()
    {
        $rooms = Room::findAll();
        
        return EngineSingleton::getEngine()->render('RoomCapacity.html.php', ['rooms' => $rooms]);
    }
}

