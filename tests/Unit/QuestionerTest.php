<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\Unit;

use Codeception\Test\Unit;
use rikmeijer\𓀁\Questioner;

final class QuestionerTest extends Unit
{
    /**
     * @test
     */
    public function WhenQuestionerAsksQuestionExpectQuestionBelongingToQuestioner(): void
    {
        $questioner = new Questioner();

        $question = $questioner->ask("How many roads must a man walk down, before you can call him a man?");

        $this->assertTrue($question->belongsTo($questioner));
    }

    /**
     * @test
     */
    public function WhenQuestionerAsksQuestionExpectQuestionBelongingToThatQuestionerAndNotAnotherQuestioner(): void
    {
        $questioner = new Questioner();
        $questioner2 = new Questioner();

        $question = $questioner->ask("How many roads must a man walk down, before you can call him a man?");

        $this->assertFalse($question->belongsTo($questioner2));
    }
}
