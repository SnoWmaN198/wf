<?php

namespace Animal;

class Dog {
    
    public const DOG_BREED = ['Fabio', 'Filipe'];
    public const DOG_COLOR = ['red', 'darkred'];
    public const DOG_NAME = 'Benfica';
    
    private $breed;
    private $color;
    private $name = self::DOG_NAME;
    
    public function __construct(string $name, string $breed, string $color) {
        $this->setName($name)
             ->setBreed($breed)
             ->setColor($color);
    }
    
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $breed
     */
    public function setBreed($breed)
    {
        if (!in_array($breed, self::DOG_BREED)) {
            throw new \RuntimeException('Wrong dog breed');
        }
        $this->breed = $breed;
        return $this;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        if (!in_array($color, self::DOG_COLOR)) {
            throw new \RuntimeException('Color not allowed');
        }
        $this->color = $color;
        return $this;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        if ($name != self::DOG_NAME) {
            throw new \RuntimeException('Choose the correct name');
        }
        $this->name = $name;
        return $this;
    }

    public function saySomething() {
        return 'Woof!';
    }
    
    public function play() {
        return 'I am a good boy';
    }
    
    public function eat() {
        return 'Feed me human!!';
    }
}

/* $rex = new Dog();

echo $rex->saySomething();                     // echo needed because function only returns something but doesn't display it
echo $rex->play();
echo $rex->eat();        */                      
