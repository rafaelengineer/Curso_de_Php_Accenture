<?php
declare(strict_types=1);

// Declarando função sem parâmetro
function saudacao() {
    echo 'Olá pessoal!' . PHP_EOL;
}
saudacao(); // Chamando a função

// Função com parâmetro
function exibeMensagem($texto) {
    echo $texto . PHP_EOL;
}
// exibeMensagem(); // Erro fatal, parametro obrigatório não informado
// exibeMensagem('Treinamento PHP');

$mensagem = 'Bom dia!';
exibeMensagem($mensagem);

// Função com parâmetros opcionais
function fazerBebida(string $tipo, string $temperatura = 'quente'): void {
    echo "Preparando $tipo $temperatura..." . PHP_EOL;
}

fazerBebida('chá');
// fazerBebida(1); // mesmo com o tipo explícito, ele aceita ou tipo

fazerBebida(temperatura: 'frio', tipo: 'café'); // Parâmetros nomeados
fazerBebida('chocolate', 'morno',);

// Função com número variáveis de parâmetros
// Os argumentos serão passados na variável como um array:
// function soma(int ...$numeros) {
function soma(string ...$numeros) {
    $soma = 0;
    foreach ($numeros as $n) {
        $soma += $n;
    }
    return $soma;
}
echo 'Soma = ' . soma(1, 2) . PHP_EOL;
echo 'Soma = ' . soma(2, 2, 3, 1) . PHP_EOL;
echo 'Soma = ' . soma(1, 4.5) . PHP_EOL; // 