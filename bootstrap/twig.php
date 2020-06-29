<?php declare(strict_types=1);

use rikmeijer\Bootstrap\Bootstrap;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return static function (Bootstrap $bootstrap, array $configuration): Environment {
    return new Environment(new FilesystemLoader($configuration['templates']));
};
