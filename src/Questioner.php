<?php declare(strict_types=1);


namespace rikmeijer\🍐goji;


class Questioner
{

    public function ask(string $question): Question
    {
        return Question::ask($question)->withQuestioner($this);
    }
}
