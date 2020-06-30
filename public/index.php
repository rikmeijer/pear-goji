<?php /** @noinspection GlobalVariableUsageInspection */
declare(strict_types=1);

$bootstrap = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

$twig = $bootstrap->resource('twig');

$variables = [];
if (array_key_exists('HTTP_ACCEPT', $_SERVER) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
    header('Content-Type: application/json');
    $template = 'api/index.json';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $variables['title'] = 'Answers';
    $variables['content'] = 'web/answers.twig';
    $template = 'web/index.twig';
} else {
    $variables['title'] = '𓀁';
    $variables['content'] = 'web/question.twig';
    $template = 'web/index.twig';
}

echo $twig->render($template, $variables);
