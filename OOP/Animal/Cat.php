<?php

namespace Animal;

class Cat extends Animal {

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
