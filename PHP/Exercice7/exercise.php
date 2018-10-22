<?php

function divide(int $value, int $divider) : float {
    if ($divider == 0) {
        throw new RuntimeException('Division by 0 is not allowed');
    }
    return ($value/$divider);
}

function arrayDivide(array $value, int $divider) : array {
    $result = [];
    foreach ($value as $base){
        try {
            $result[] = divide($base, $divider);
        } catch (RuntimeException $e) {
            $result[] = $base;
        }
    }
    return $result;
}
