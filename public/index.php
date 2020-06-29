<?php /** @noinspection GlobalVariableUsageInspection */
declare(strict_types=1);

$bootstrap = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

$twig = $bootstrap->resource('twig');

if (array_key_exists('HTTP_ACCEPT', $_SERVER) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
    header('Content-Type: application/json');
    exit('{"status":"ok"}');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $twig->render('answers.twig', []);
} else {
    echo $twig->render('index.twig', []);
}
