<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\acceptance;

use AcceptanceTester;

final class FrontPageCest
{
    public function _before(AcceptanceTester $I): void
    {
    }

    public function _after(AcceptanceTester $I): void
    {
    }

    // tests

    public function WhenVisitingFrontPageExpectTitleToBeMAWIHATOMO(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->seeInTitle('𓀁');
    }

    public function WhenVisitingFrontPageExpectHTML5IsW3cCompatible(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->seeValidHTML($I->grabPageSource());
    }

    public function WhenVisitingFrontPageExpectTextFieldAvailable(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->seeElement('input[type=text]', ['placeholder' => 'Stel een vraag']);
    }

    public function WhenVisitingFrontPageExpectSeeingMAWIHATOMOAsTitleElement(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->see('𓀁', 'h1');
    }
}
