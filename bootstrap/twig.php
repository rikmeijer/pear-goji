<?php declare(strict_types=1);

use rikmeijer\Bootstrap\Bootstrap;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return function (Bootstrap $bootstrap): Environment {

    $loader = new FilesystemLoader($bootstrap->config('TWIG')['templates']);
    return new Environment($loader);
};
