<?php 

class Human {
    
    private $hairColor = 'red';
    
    public function setHairColor(string $color) {
        
        $allowedColors = ['red', 'brown', 'blondy'];
        
        if (!in_array($color, $allowedColors)) {
            throw new RuntimeException('Color not allowed '.$color);
        }
        
        $this->hairColor = $color;
    }

    public function getHairColor() : string {
        
        return $this->hairColor;
    }
}

$dude = new Human();

echo $dude->getHairColor();                 // red
$dude->setHairColor('brown');
echo $dude->getHairColor();                 // brown
