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

    public function testWhen_VisitingFrontPage_Expect_TitleToBeMaWiHaToMo(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->seeInTitle('𓀁');
    }

    public function testWhen_VisitingFrontPage_Expect_HTML5isW3CCompatible(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->seeValidHTML($I->grabPageSource());
    }

    public function testWhen_VisitingIndex_Expect_TextFieldAvailable(AcceptanceTester $I): void
    {
        $I->amOnPage('/');
        $I->seeElement('input[type=text]', ['placeholder' => 'Stel een vraag']);
    }
}
