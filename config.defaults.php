<?php declare(strict_types=1);

use rikmeijer\𓀁\HTTP\IndexAnswers;
use rikmeijer\𓀁\HTTP\IndexQuestion;

return [
    'twig' => [
        'templates' => __DIR__ . DIRECTORY_SEPARATOR . 'templates'
    ],
    'routes' => [
        'index' => [
            '/',
            [
                'GET' => IndexQuestion::class,
                'POST' => IndexAnswers::class
            ]
        ]
    ]
];
