<?php

// Função anônima que recebe um parâmetro e retorna o dobro do valor
$dobro = function($valor) {
    return $valor * 2;
};

// Chamando a função anônima
echo $dobro(5); // Saída: 10

$numeros = [2, 4, 5];

$dobro = function ($num) { 
    return $num * 2; 
};
echo $dobro(3);

echo array_map($dobro, $numeros);

