<?php declare(strict_types=1);

namespace rikmeijer\goji\tests;

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
        $answerOriginal = new Answer('5');

        $answer = $question->answer($answerOriginal);

        $this->assertFalse($answerOriginal->belongsTo($question));
        $this->assertTrue($answer->belongsTo($question));
        $this->assertNotEquals($answerOriginal, $answer);
    }
}
