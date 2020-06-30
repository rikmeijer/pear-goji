<?php declare(strict_types=1);

use rikmeijer\Bootstrap\Bootstrap;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

return static function (Bootstrap $bootstrap, array $configuration): callable {
    if (array_key_exists('routes', $configuration) === false) {
        throw new RuntimeException('No routes configured');
    }

    $routes = new RouteCollection();
    foreach ($configuration['routes'] as $identifier => $route) {
        if (is_array($route[1]) === false) {
            $routes->add($identifier, new Route($route[0], ['_controller' => $route[1]]));
        } else {
            foreach ($route[1] as $method => $controller) {
                $routes->add(
                    $method . '-' . $identifier,
                    new Route($route[0], ['_controller' => $controller], [], [], null, null, $method)
                );
            }
        }
    }

    return static function (RequestContext $context) use ($routes) : UrlMatcher {
        return new UrlMatcher($routes, $context);
    };
};
