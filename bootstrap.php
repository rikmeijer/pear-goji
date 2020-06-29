<?php declare(strict_types=1);

use rikmeijer\Bootstrap\Bootstrap;

// include composer autoloader
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
return new Bootstrap(__DIR__);
