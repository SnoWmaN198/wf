<?php
namespace MicroForce\Factory;

use MicroForce\Model\Room;

class RoomFactory
{

    private $name;

    private $capacity;

    public function __construct(string $name, int $capacity)
    {
        $this->name = $name;
        $this->capacity = $capacity;
    }

    public function createRoom():Room
    {
        $room = new Room();
        $room->setName($this->name);
        $room->setCapacity($this->capacity);
        return $room;
    }
}

