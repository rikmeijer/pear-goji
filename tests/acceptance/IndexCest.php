<?php

namespace rikmeijer\𓀁\tests\acceptance;

use AcceptanceTester;

final class IndexCest
{
    public function _before(AcceptanceTester $I): void
    {
    }

    public function _after(AcceptanceTester $I): void
    {
    }

    // tests

    public function WhenVisitingFrontPageExpectTitleToBeMawihatomo(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->seeInTitle('𓀁');
    }

    public function WhenVisitingFrontPageExpectHTML5IsW3cCompatible(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->seeValidHTML($I->grabPageSource());
    }

    public function WhenVisitingIndexExpectTextFieldAvailable(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->seeElement('input[type=text]', ['placeholder' => 'Stel een vraag']);
    }
}
