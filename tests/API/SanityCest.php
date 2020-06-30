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
}
