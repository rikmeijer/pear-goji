<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\Unit;

use PHPUnit\Framework\TestCase;
use rikmeijer\𓀁\Answer;
use rikmeijer\𓀁\Aspect;
use rikmeijer\𓀁\Pointcut;
use rikmeijer\𓀁\Question;

class QuestionTest extends TestCase
{
    public function testQuestionCanBeAsked()
    {
        $question = Question::ask("How many roads must a man walk down, before you can call him a man?");
        $this->assertInstanceOf(Question::class, $question);
    }

    public function testAspectWrapsQuestion()
    {
        $question = Question::ask("How many roads must a man walk down, before you can call him a man?");
        $question = Aspect::wrap($question);
        $this->assertInstanceOf(Question::class, $question);
        $question->answer(new Answer('dd'));
    }

    public function testAspectCanCreatePointCut()
    {
        $question = Question::ask("How many roads must a man walk down, before you can call him a man?");
        $question = Aspect::wrap($question);
        $triggered = false;
        $orignalAnswer = new Answer('dd');

        $this->assertInstanceOf(Question::class, $question);
        $question->withPointcut((new Pointcut())->withBefore(function (Answer $answer) use (&$triggered, $orignalAnswer) {
            $triggered = ($orignalAnswer === $answer);
        }))->answer($orignalAnswer);

        $this->assertTrue($triggered);
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
