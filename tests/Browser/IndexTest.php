<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\Browser;

use rikmeijer\𓀁\tests\BrowserTest;

class IndexTest extends BrowserTest
{
    public function testIndexAvailable(): void
    {
        $this->url('/');
        $this->assertEquals('', $this->title());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->setBrowserUrl('http://' . $_ENV['PHP_SERVER_ADDRESS']);
        $this->setBrowser('firefox');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->stop();
    }
}
