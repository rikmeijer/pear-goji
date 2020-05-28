<?php declare(strict_types=1);


namespace rikmeijer\goji;


class Questioner
{

    /**
     * Questioner constructor.
     */
    public function __construct()
    {
    }

    public function ask(string $question): Question
    {
        return Question::ask($question);
    }
}
