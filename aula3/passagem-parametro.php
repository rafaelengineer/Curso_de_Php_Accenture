<?php

$soma = 2;

// Função com passagem de parâmetros por valor
function dobrarValor(int $num): int {
    $num = $num * 2;
    return $num;
}

echo dobrarValor($soma);
echo PHP_EOL . $soma;

// Função com passagem de parâmetros por referência
function triplicarValor(&$num) {
    $num = $num * 3;
    return $num;
}

function triplicar() {
    global $soma;
    
    $soma = $soma * 2;
    return $soma;
}

echo PHP_EOL . triplicarValor($soma);
echo PHP_EOL . $soma;