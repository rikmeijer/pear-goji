<?php

namespace rikmeijer\𓀁\tests\API;

use ApiTester;
use Codeception\Util\HttpCode;

final class SanityCest
{
    public function _before(ApiTester $I): void
    {
    }

    public function ExpectAPIAvailable(ApiTester $I): void
    {
        $I->sendGET('/');
        $I->seeResponseCodeIs(HttpCode::OK);
    }

    public function WhenSendingHeaderAcceptWithApplication_JSONExpectJSONResponse(ApiTester $I): void
    {
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendGET('/');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['status' => 'ok']);
    }

    public function WhenSendingHeaderAcceptText_HTMLExpectHTMLResponse(ApiTester $I): void
    {
        $I->haveHttpHeader('Accept', 'text/html');
        $I->sendGET('/');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeHttpHeader('Content-Type', 'text/html; charset=UTF-8');
        $I->seeResponseContains('<!doctype html>');
    }
}
