<?php
require_once './../vendor/autoload.php';

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use TreinamentoPHP\BuscadorDeCriticas\Classes\Buscador;
// use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;

// create a log channel
$log = new \Monolog\Logger('BuscadorDeCriticas');
$log->pushHandler(new StreamHandler('./../buscador.log', Level::Warning));

// add records to the log
$log->info('Buscador acessado');

$url     = '/filmes/filme-269975/criticas/espectadores/';
$baseUrl = 'https://www.adorocinema.com';
$client = new Client(['base_uri' => $baseUrl, 'verify' => false]);
$crawler = new Crawler();
$buscador = new Buscador($client, $crawler);
$criticas = $buscador->buscar($url);
// MySQL
$dsn = 'mysql:host=localhost:3306;dbname=db_criticas';
$username = 'root';
$password = 'mysql';
$options =  [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true];
$conexao = new PDO($dsn, $username, $password, $options);

echo 'Conectado - dsn: <b>' . $dsn . '<br>';
try{
    echo 'tentativa de inicio da transação...' . '<br>';
    // Connecting to MySQL
    //$conexao = new PDO('mysql:host=localhost;dbname= db_criticas', $username, $password);
    echo 'opá...' . '<br>';
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'opá 2...' . '<br>';
    $conexao->beginTransaction();
    echo 'Inicio da transação...' . '<br>';
    foreach ($criticas as $c) {
        $nota = $conexao->quote($c['rate']);
        $critica = $conexao->quote($c['text']);
        echo $nota . '<br>';

        $conexao->query("INSERT INTO criticas (nota, critica) VALUES ($nota, $critica)");
    }
    $conexao->commit();

    // $conexao->beginTransaction();
    // foreach ($criticas as $c) {
    //     $rate = "{$c['rate']}";
    //     $text = "{$c['text']}";
    //     echo '<br>';
        
    //     $conexao->query("INSERT INTO criticas (nota, critica) VALUES ($rate, $text)");
    //     echo "INSERT INTO criticas (nota, critica) VALUES ($rate, $text)" . '<br>';
    //     echo '<br>';
    //     $conexao->query("UPDATE criticas SET nota = $rate WHERE critica = $text");
    // }
    // $conexao->commit();
    echo "Critica inserida com sucesso: ". $conexao->lastInsertId();


} catch (\PDOException $e) {
    $conexao->rollBack();
    echo "Mensagem: {$e->getMessage()}";
    echo "<br>Código: {$e->getCode()}";
}

    
    $htmlToPdf = '<ul>';
    foreach ($criticas as $c) {
        $htmlToPdf .= "<li><b>Nota:</b> {$c['rate']} / <b>Crítica:</b> {$c['text']}</li>";
    }
    $htmlToPdf .= '<ul>';
// var_dump($criticas);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Críticas de filmes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="container bg-primary-subtle">
    <h1>Buscador de críticas de filmes</h1>
    <form action="paginaPdf.php" method="post">
        <input type="hidden" name="htmlToPdf" id="htmlToPdf" value="<?=$htmlToPdf?>">
        <input type="submit" value="Gerar PDF" class="btn btn-primary">
    </form>
    <?= $htmlToPdf ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

