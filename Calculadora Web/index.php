<?php session_start();?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Web</title>
</head>
<body>
    <p><h1>"Calculadora"</h1></p>
    <p><h3>Esta calculadora funciona com expressões aritimetias regulares</h3></p>
    <p><h3>Só são aceitos as quatro operações básicas (+ - * /)</h3></p>
    <p><h3>Concatene operandos e operadores para formar sua expressão.</h3></p>
    <?php
        include 'Calculadora.php';
    ?>
    <form Exp="inputForm" action="" method = "post">
        Insira uma expressão matemática : <input Exp = "Exp" type = "text" size="100" maxlength="100"  />
        <input type="submit" value="Calcula" onclick="return Calculate()"/>
        <input type="submit" name="Nova expressão" value = "Insira nova Expressão"/>
    </form>
</body>
</html>