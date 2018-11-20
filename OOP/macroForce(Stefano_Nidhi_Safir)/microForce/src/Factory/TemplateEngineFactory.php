<?php
namespace MicroForce\Factory;

use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\EngineInterface;

class TemplateEngineFactory
{
    private $config = ['engine' =>null, 'template_location' => null];
    
    public function __construct(string $engine, string $templateLocation)
    {
        $this->config['engine'] = $engine;
        $this->config['template_location'] = $templateLocation;
    }
    
    public function createEngine() : EngineInterface
    {
        $loader = new FilesystemLoader($this->config['template_location']);
        
        $engine = $this->config['engine'];
        return new $engine(new TemplateNameParser(), $loader);
    }
}
