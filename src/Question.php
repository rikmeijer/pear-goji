<?php declare(strict_types=1);

namespace rikmeijer\goji;

class Question
{
    private string $question;

    public function __construct(string $question)
    {
        $this->question = $question;
    }

    public function answer(string $answer): Answer
    {
        return new Answer($this, $answer);
    }
}
