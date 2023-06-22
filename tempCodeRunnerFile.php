<?php

function validacao($expMatematica)
{
    $validChars = '0123456789+-*/ ';

    // Remove espaços
    $expMatematica = str_replace(' ', '', $expMatematica);

    // Verifica caracteres inválidos
    for ($i = 0; $i < strlen($expMatematica); $i++) {
        if (strpos($validChars, $expMatematica[$i]) === false) {
            return false;
        }
    }

    return true;
}

function splitExp($expMatematica)
{
    $expMatematica = str_replace(' ', '', $expMatematica);
    $operadores = ['+', '-', '*', '/'];
    $split = [];
    $operandos = '';

    for ($i = 0; $i < strlen($expMatematica); $i++) {
        $char = $expMatematica[$i];
        if (in_array($char, $operadores)) {
            if ($operandos !== '') {
                $split[] = $operandos;
                $operandos = '';
            }
            $split[] = $char;
        } else {
            $operandos .= $char;
        }
    }

    if ($operandos !== '') {
        $split[] = $operandos;
    }

    return $split;
}

function calculate($expMatematica)
{
    if (!validacao($expMatematica)) {
        return "Invalid expression.";
    }

    $split = splitExp($expMatematica);
    $operandos = [];
    $operadores = [];
    $result = 0;

    foreach ($split as $elementos) {
        if (is_numeric($elementos)) {
            $operandos[] = $elementos;
        } else {
            $operadores[] = $elementos;
        }
    }

    if (count($operandos) === 0 || count($operadores) === 0) {
        return "Invalid expression.";
    }

    $resultado = $operandos[0];

    for ($i = 1; $i < count($operandos); $i++) {
        switch ($operadores[$i - 1]) {
            case '+':
                $resultado += $operandos[$i];
                break;
            case '-':
                $resultado -= $operandos[$i];
                break;
            case '*':
                $resultado *= $operandos[$i];
                break;
            case '/':
                if ($operandos[$i] == 0) {
                    return "Division by zero error.";
                }
                $resultado /= $operandos[$i];
                break;
        }
    }

    return $resultado;
}

$expMatematica = readline("Enter an expression: ");
$resultado = calculate($expMatematica);
echo "Resultado: " . $resultado . "\n";
?>