<?php declare(strict_types=1);

namespace rikmeijer\goji;


class Question
{
    private string $question;

    private function __construct(string $question)
    {
        $this->question = $question;
    }

    public static function ask(string $question): self
    {
        return new self($question);
    }
}
