<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\Unit;

use Codeception\Test\Unit;
use rikmeijer\𓀁\Answer;
use rikmeijer\𓀁\Aspect;
use rikmeijer\𓀁\Pointcut;
use rikmeijer\𓀁\Question;

final class AspectTest extends Unit
{
    /**
     * @test
     */
    public function WhenQuestionWrappedExpectPointcutToBeCreatableOnQuestion(): void
    {
        $question = Question::ask("How many roads must a man walk down, before you can call him a man?");
        $question = Aspect::wrap($question);
        $triggered = false;
        $orignalAnswer = new Answer('dd');

        $this->assertInstanceOf(Question::class, $question);
        $question->withPointcut((new Pointcut())->withBefore(function (Answer $answer) use (
            &$triggered,
            $orignalAnswer
        ) {
            $triggered = ($orignalAnswer === $answer);
        }))->answer($orignalAnswer);

        $this->assertTrue($triggered);
    }
}
