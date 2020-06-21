<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\Browser;

use rikmeijer\𓀁\tests\BrowserTest;

class IndexTest extends BrowserTest
{
    public function testIndexAvailable(): void
    {
        $this->driver->navigate()->to('http://' . $_ENV['PHP_SERVER_ADDRESS'] . '/');
        $this->assertEquals('', $this->driver->getTitle());
    }
}
