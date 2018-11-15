<?php

namespace Animal;

class Dog extends Animal {

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
