<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use rikmeijer\goji\Answer;
use rikmeijer\goji\Question;

class QuestionTest extends TestCase
{
    public function testQuestionCanBeAsked()
    {
        $question = Question::ask("How many roads must a man walk down, before you can call him a man?");
        $this->assertInstanceOf(Question::class, $question);
    }

    public function testQuestionCanBeAnswered()
    {
        $question = Question::ask("How many roads must a man walk down, before you can call him a man?");

        $answer = $question->answer('5');

        $this->assertInstanceOf(Answer::class, $answer);
    }
}
