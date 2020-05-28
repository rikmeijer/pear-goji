<?php declare(strict_types=1);

namespace rikmeijer\goji\tests;

use PHPUnit\Framework\TestCase;
use rikmeijer\goji\Questioner;

class QuestionerTest extends TestCase
{
    public function testWhen_QuestionerAsksQuestion_Expect_QuestionBelongingToQuestioner()
    {
        $questioner = new Questioner();

        $question = $questioner->ask("How many roads must a man walk down, before you can call him a man?");

        $this->assertTrue($question->belongsTo($questioner));
    }

    public function testWhen_QuestionerAsksQuestion_Expect_QuestionBelongingToThatQuestionerAndNotAnotherQuestioner()
    {
        $questioner = new Questioner();
        $questioner2 = new Questioner();

        $question = $questioner->ask("How many roads must a man walk down, before you can call him a man?");

        $this->assertFalse($question->belongsTo($questioner2));
    }
}
