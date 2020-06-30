<?php declare(strict_types=1);


namespace rikmeijer\𓀁\HTTP;

class IndexQuestion
{
    public function __invoke(): array
    {
        return [
            'web/index.twig',
            [
                'title' => '𓀁',
                'content' => 'web/question.twig'
            ]
        ];
    }
}
