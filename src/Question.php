<?php declare(strict_types=1);

namespace rikmeijer\𓀁;

class Question
{
    private string $question;
    /**
     * @var Questioner
     */
    private Questioner $questioner;

    private function __construct(string $question)
    {
        $this->question = $question;
    }

    public static function ask(string $question)
    {
        return new self($question);
    }

    public function answer(Answer $answer): Answer
    {
        return $answer->withQuestion($this);
    }

    public function belongsTo(Questioner $questioner): bool
    {
        return $this->questioner === $questioner;
    }

    public function withQuestioner(Questioner $questioner)
    {
        $question = clone $this;
        $question->questioner = $questioner;
        return $question;
    }
}
