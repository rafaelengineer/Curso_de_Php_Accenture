<?php

$a = [1, 2, 3, 4, 5];

// Função anônima
$dobro = function($valor) { 
    return $valor * 2;
};

// Função anônima abreviada (a partir do PHP 7.4)
$cubo = fn($n) => $n * $n * $n;


$b = array_map($cubo, $a);

print_r($b);