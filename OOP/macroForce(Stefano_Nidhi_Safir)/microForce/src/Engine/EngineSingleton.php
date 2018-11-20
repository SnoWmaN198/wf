<?php
namespace MicroForce\Engine;

use Symfony\Component\Templating\EngineInterface;

class EngineSingleton
{
    static private $engine;
    
    static public function getEngine() : EngineInterface
    {
        if (!self::$engine) {
            throw new \LogicException('Trying to load unconfigured engine instance');
        }
        return self::$engine;
    }

    static public function setEngine(EngineInterface $engine) : void
    {
        self::$engine = $engine;
    }
}

