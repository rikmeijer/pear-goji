<?php declare(strict_types=1);

namespace rikmeijer\goji;

class Answer
{
    private Question $question;
    private string $answer;

    public function __construct(Question $question, string $answer)
    {
        $this->question = $question;
        $this->answer = $answer;
    }

    public function belongsTo(Question $question)
    {
        return $this->question === $question;
    }
}
