<?php

// escopo global
$numero1 = 10;

function somaNumeros() {
    // acessando escopo global com a palavra chave global
    global $numero1; 

    $numero2 = 20; // escopo local

    return $numero1 + $numero2;
}

echo somaNumeros();

echo PHP_EOL . PHP_EOL;

$a = 1;
$b = 2;

function Soma() {
    $GLOBALS['b'] = $GLOBALS['a'] + $GLOBALS['b'];
}

Soma();
echo $b;

// superglobais
echo 'Total: '; 
print_r(count($GLOBALS));
foreach ($GLOBALS as $key => $value) {
    echo $key . PHP_EOL;
    // print_r($value);
}

// print_r($GLOBALS);