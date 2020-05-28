<?php declare(strict_types=1);

namespace rikmeijer\goji;

class Answer
{
    private Question $question;
    private string $answer;

    public function __construct(string $answer)
    {
        $this->answer = $answer;
    }

    public function belongsTo(Question $question): bool
    {
        return isset($this->question) && $this->question === $question;
    }

    public function withQuestion(Question $question)
    {
        $answer = clone $this;
        $answer->question = $question;
        return $answer;
    }
}
