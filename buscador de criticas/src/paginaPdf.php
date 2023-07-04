<?php
require_once './../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <h1>Buscador de críticas de filmes</h1>
    <?php 
        use Monolog\Handler\StreamHandler;
        use Monolog\Level;
        $htmlToPdf = '<h1>Buscador de críticas de filmes</h1>' . $_POST['htmlToPdf'];
        gerarPdf( $htmlToPdf, 'críticas.pdf' );

        $log = new \Monolog\Logger('BuscadorDeCriticas');
        $log->pushHandler(new StreamHandler('./../buscador.log', Level::Warning));
        $log->alert('Gerou pdf');
    ?>
</body>
</html>