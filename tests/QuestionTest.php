<?php declare(strict_types=1);

namespace rikmeijer\goji\tests;

use PHPUnit\Framework\TestCase;
use rikmeijer\goji\Question;

class QuestionTest extends TestCase
{
    public function testQuestionCanBeAnswered()
    {
        $question = new Question("How many roads must a man walk down, before you can call him a man?");

        $answer = $question->answer('5');

        $this->assertTrue($answer->belongsTo($question));
    }
}
