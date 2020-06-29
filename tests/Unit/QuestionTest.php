<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\Unit;

use Codeception\Test\Unit;
use rikmeijer\𓀁\Answer;
use rikmeijer\𓀁\Question;

final class QuestionTest extends Unit
{
    /**
     * @test
     */
    public function WhenQuestionAnsweredExpectAnswerToBelongToQuestion(): void
    {
        $question = Question::ask("How many roads must a man walk down, before you can call him a man?");
        $answerOriginal = new Answer('5');

        $answer = $question->answer($answerOriginal);

        $this->assertFalse($answerOriginal->belongsTo($question));
        $this->assertTrue($answer->belongsTo($question));
        $this->assertNotEquals($answerOriginal, $answer);
    }
}
