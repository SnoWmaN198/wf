<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\DTO\Car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Extractor\BrandExtractor;
use App\Extractor\ModelExtractor;
use App\Extractor\ExtractorInterface;

class DefaultController
{
    
    private $twig;
    private $brandExtractor;
    private $modelExtractor;
    
    public function __construct(\Twig_Environment $twig, ExtractorInterface $brandExtractor, ExtractorInterface $modelExtractor) {
        $this->twig = $twig;
        $this->brandExtractor = $brandExtractor;
        $this->modelExtractor = $modelExtractor;
    }
    
    /**
     * Homepage
     * 
     * The homepage of the application
     * 
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $carList = [];
        
        $car1 = new Car();
        $car1->brand = 'Renault';
        $car1->color = 'grey';
        $car1->seats = ['front left', 'front right'];
        $car1->setModel('velsatis');
        
        $car2 = new Car();
        $car2->brand = 'Fiat';
        $car2->color = 'white';
        $car2->seats = ['back left', 'back right'];
        $car2->setModel('punto');
        
        array_push($carList, $car1);
        array_push($carList, $car2);
        
        return new Response(
            $this->twig->render(
                'homepage.html.twig', 
                ['cars' => $carList, 'brandList' => $this->brandExtractor->extractList($carList), 'modelList' => $this->modelExtractor->extractList($carList)])
        );
    }
}






