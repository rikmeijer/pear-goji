<?php /** @noinspection GlobalVariableUsageInspection */
declare(strict_types=1);

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$bootstrap = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

$matcher = $bootstrap->resource('routes')->createMatcherForRequestContext(new RequestContext(
    '/',
    $_SERVER['REQUEST_METHOD']
));
assert($matcher instanceof UrlMatcher);

$route = $matcher->match($_SERVER['REQUEST_URI']);

$twig = $bootstrap->resource('twig');

$controller = new $route['_controller']();
$twigArguments = $controller();

$variables = [];
if (array_key_exists('HTTP_ACCEPT', $_SERVER) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
    header('Content-Type: application/json');
    $twigArguments[0] = 'api/index.json';
    $twigArguments[1] = [];
}

echo $twig->render($twigArguments[0], $twigArguments[1]);
