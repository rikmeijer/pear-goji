<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests;

use PHPUnit\Framework\TestCase;
use rikmeijer\𓀁\{Answer, Aspect, Pointcut, Question};


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

        $this->assertInstanceOf(Question::class, $question);
        $question->withPointcut((new Pointcut('answer'))->withBefore(function (Answer $answer) use (&$triggered) {
            $triggered = true;
        }))->answer(new Answer('dd'));

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
