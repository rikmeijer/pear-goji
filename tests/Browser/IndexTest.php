<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\Browser;

use Facebook\WebDriver\WebDriverBy;
use rikmeijer\𓀁\tests\BrowserTest;

class IndexTest extends BrowserTest
{
    public function testWhen_VisitingFrontPage_Expect_TitleToBeMaWiHaToMo(): void
    {
        self::$driver->navigate()->to($_ENV['PHP_SERVER_ADDRESS'] . '/');
        $this->assertEquals('𓀁', self::$driver->getTitle());
    }

    public function testWhen_VisitingIndex_Expect_TextFieldAvailable(): void
    {
        self::$driver->navigate()->to($_ENV['PHP_SERVER_ADDRESS'] . '/');
        $searchBox = self::$driver->findElement(WebDriverBy::cssSelector('input[type=text]'));
        $this->assertEquals('Stel een vraag', $searchBox->getAttribute('placeholder'));
    }
}
