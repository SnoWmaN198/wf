<?php
namespace MicroForce\Kernel;

use Symfony\Component\Routing\RouteCollection;
use MicroForce\Controller\HomepageController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use MicroForce\Engine\EngineSingleton;
use MicroForce\Connection\ConnectionSingleton;

class Kernel
{
    public function loadConnection(array $configuration) : \PDO 
    {
        return new \PDO
        (sprintf(
                'mysql:host=%s;dbname=%s',
                $configuration['host'],
                $configuration['dbname']
            ),
            $configuration['user'],
            $configuration['password'] 
        );
    }
    
    public function loadTemplateEngine($templateLocation) : EngineInterface
    {
        $loader = new FilesystemLoader($templateLocation . '/%name%');
        return new PhpEngine(new TemplateNameParser(), $loader);
        
    }
    
    public function getConfig() 
    {
        return include __DIR__ . '/../../config/config.php';
    }
    
    public function start() : string
    {
        try {
            ConnectionSingleton::setConnection($this->loadConnection($this->getConfig()['DB']));
        } catch (\PDOException $e) {
            return '500';
        }
        
        $engine = $this->loadTemplateEngine($this->getConfig()['template_location']);
        EngineSingleton::setEngine($engine);
        
        // Execute routing
        $routeDefinition = $this->executeRouting();
        // If we can match a controller
        if ($routeDefinition !== null) {
            // Load the controller
            $controllerName = $routeDefinition['_controller'];
            $controller = new $controllerName();
            // Call the controller method
            $method = $routeDefinition['_method'];
            return $controller->$method();
        }

        return '404';
    }
    
    private function executeRouting() : ?array
    {
        // Load routing informations
        $collection = $this->loadRouting();
        
        // Try to match a route
        try {
            $context = new RequestContext();
            $context->fromRequest(Request::createFromGlobals());
            
            $matcher = new UrlMatcher($collection, $context);
            return $matcher->match($context->getPathInfo());
            // Return the route definition
        } catch (\Exception $e) {
            // Catch exception
            // Return null
            return null;
        }
    }

    private function loadRouting() : RouteCollection
    {
        // Create each routes
        $homepage = new Route(
            '/',
            [
                '_controller' => HomepageController::class,
                '_method' => 'homepage'
            ]
            );
        // Add them to the route collection
        $collection = new RouteCollection();
        $collection->add('homepage', $homepage);
        // return the collection
        return $collection;
    }
    
}
