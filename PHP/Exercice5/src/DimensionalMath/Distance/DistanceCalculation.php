<?php

// namespace DimensionalMath\Distance  (no need to put something infront of threeDimensionDistance when calling it in $distance)

namespace Distance;

function subSquare($x, $y) {
    return pow($x, 2) - (2 * $x * $y) + pow($y, 2);
}

function threeDimensionDistance($pointA, $pointB) {
    list($ax, $ay, $az) = $pointA;
    list($bx, $by, $bz) = $pointB;
    return sqrt(subSquare($ax, $bx) + subSquare($ay, $by) + subSquare($az, $bz));
}
