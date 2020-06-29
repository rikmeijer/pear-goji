<?php /** @noinspection GlobalVariableUsageInspection */
declare(strict_types=1);

$bootstrap = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

$twig = $bootstrap->resource('twig');

$variables = [];
if (array_key_exists('HTTP_ACCEPT', $_SERVER) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
    header('Content-Type: application/json');
    $template = 'api/index.json';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $template = 'web/answers.twig';
} else {
    $template = 'web/index.twig';
}

echo $twig->render($template, $variables);
