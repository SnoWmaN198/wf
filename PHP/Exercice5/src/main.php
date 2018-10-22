<?php
use function DimensionalMath\Distance\threeDimensionDistance;
use function DimensionalMath\Vector\getVectorAngle;

require_once __DIR__.'/DimensionalMath/Distance/DistanceCalculation.php';
require_once __DIR__.'/DimensionalMath/Vector/AngleCalculation.php';


$distance = Distance\threeDimensionDistance(
    [1, 1, 1],
    [2, 2, 2]
);

$angle = Vector\getVectorAngle([1, 6], [3, 12]);


echo "$distance  \n";

echo $angle;