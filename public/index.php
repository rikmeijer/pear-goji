<?php /** @noinspection GlobalVariableUsageInspection */
declare(strict_types=1);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$loader = new FilesystemLoader(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates');
$twig = new Environment($loader);

if (array_key_exists('HTTP_ACCEPT', $_SERVER) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
    header('Content-Type: application/json');
    exit('{"status":"ok"}');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $twig->render('answers.html', []);
} else {
    echo $twig->render('index.html', []);
}
