<?php

namespace rikmeijer\𓀁\tests\API;

use ApiTester;
use Codeception\Util\HttpCode;

final class SanityCest
{
    public function _before(ApiTester $I): void
    {
    }

    // tests
    public function tryToTest(ApiTester $I): void
    {
    }

    public function testAPIAvailable(ApiTester $I): void
    {
        $I->sendGET('/');
        $I->seeResponseCodeIs(HttpCode::OK);
    }

    public function testAPI_When_AcceptApplication_JSON_Expect_JSONResponse(ApiTester $I): void
    {
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendGET('/');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['status' => 'ok']);
    }

    public function testAPI_When_AcceptTextHTML_Expect_HTMLResponse(ApiTester $I): void
    {
        $I->haveHttpHeader('Accept', 'text/html');
        $I->sendGET('/');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeHttpHeader('Content-Type', 'text/html; charset=UTF-8');
        $I->seeResponseContains('<!doctype html>');
    }
}
