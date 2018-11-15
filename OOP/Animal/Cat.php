<?php

namespace Animal;

class Cat {
    
    private const MAX_AGE = 25;
    
    private $breed;
    private $color;
    private $age;
    
    /**
     * @return mixed
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $breed
     */
    public function setBreed($breed)
    {
        $this->breed = $breed;
        return $this;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    public function saySomething() {
        return 'Miau!'; 
    }
    
    public function play() {
        return 'I want to play';
    }
    
    public function eat() {
        return 'HUNGRY!!!!!'; 
    }    
}

/* $puss = new Cat();


echo Cat::MAX_AGE;                              // to access a constant (const) the class needs to be defined (cat), needs to be inside the class if the constant is private
echo self::MAX_AGE;                             // self defines the current class he's in

echo $puss->saySomething();                     // echo needed because function only returns something but doesn't display it
echo $puss->play();
echo $puss->eat(); */                              
