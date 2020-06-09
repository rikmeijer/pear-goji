<?php declare(strict_types=1);


namespace rikmeijer\𓀁;


class Questioner
{

    public function ask(string $question): Question
    {
        return Question::ask($question)->withQuestioner($this);
    }
}
