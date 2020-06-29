<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\acceptance;

use AcceptanceTester;

final class AnswersCest
{
    public function _before(AcceptanceTester $I): void
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I): void
    {
    }


    public function WhenQuestionSubmittedExpectLandingOnAnswersPage(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->submitForm('body > form', [
            'question' => 'How many roads must a man walk down, before you can call him a man?'
        ]);

        $I->see('Answers', 'h1');
        $I->dontSeeElement('input[type=text]', ['placeholder' => 'Stel een vraag']);
    }
}
