<?php
namespace App\Extractor;

use App\DTO\Car;

class ModelExtractor implements ExtractorInterface
{
    /**
     * Extract
     *
     * Extract the model of the given car. Throw RuntimeException
     * if parameter is not a Car instance.
     *
     * @param Car $element The car from where to extract the model
     *
     * @return string
     * @throws \RuntimeException
     */
    public function extract($element)
    {
        if (! $element instanceof Car) {
            throw new \RuntimeException('Instance of car required');
        }
        
        return $element->getModel();
    }
    
    /**
     * Extract list
     *
     * Extract a list of models from a list of cars. Throw a RuntimeException if one of the given elements is not a car.
     *
     *  @param array $elements The list of cars from where to extract the models.
     *
     *  @return array
     *  @throws \RuntimeException
     */
    public function extractList(array $elements) : array
    {
        $modelArray = [];
        foreach ($elements as $element) {
            $modelArray[] = $this->extract($element);
        }
        
        return $modelArray;
    }
}

