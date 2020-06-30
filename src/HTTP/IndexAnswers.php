<?php declare(strict_types=1);


namespace rikmeijer\𓀁\HTTP;

class IndexAnswers
{
    public function __invoke(): array
    {
        return [
            'web/index.twig',
            [
                'title' => 'Answers',
                'content' => 'web/answers.twig'
            ]
        ];
    }
}
