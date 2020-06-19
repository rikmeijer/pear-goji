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
        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowserUrl('http://127.0.0.1:8080');
        $this->setBrowser('firefox');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->stop();
    }
}
