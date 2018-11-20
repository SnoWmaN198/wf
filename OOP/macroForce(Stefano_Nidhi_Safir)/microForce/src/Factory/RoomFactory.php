<?php 
use MicroForce\Model\Room; 

class RoomFactory
{
    private $label;
    private $description;
    
    public function __construct(string $label, string $desc)
    {
        $this->label = $label;
        $this->description = $desc;
    }
    
    public function createRoom() : Room
    {
        $room = new Room();
        $room->setDescription($this->description);
        $room->setLabel($this->label);
        return $room;
    }
}
