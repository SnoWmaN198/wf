<?php

namespace Animal;

abstract class Animal {
    
    public const ALLOWED_BREED = ['Fabio', 'Filipe'];
    public const ALLOWED_COLOR = ['red', 'darkred'];
    public const ALLOWED_NAME = 'Benfica';
    
    protected $breed;
    protected $color;
    protected $name = self::ALLOWED_NAME;
    
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
        if (!in_array($breed, self::ALLOWED_BREED)) {
            throw new \RuntimeException('Wrong breed');
        }
        $this->breed = $breed;
        return $this;
    }
    
    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        if (!in_array($color, self::ALLOWED_COLOR)) {
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
        if ($name != self::ALLOWED_NAME) {
            throw new \RuntimeException('Choose the correct name');
        }
        $this->name = $name;
        return $this;
    }
    
    public abstract function saySomething();
    
    public abstract function play();
    
    public abstract function eat();
}
