<?php declare(strict_types=1);


namespace rikmeijer\𓀁\tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

abstract class APITest extends TestCase
{
    public static Server $httpd;
    protected Client $http;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$httpd = new Server('C:\php\7.4.6\php.exe', '127.0.0.1:8080');
        self::$httpd->start(dirname(__DIR__));
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        self::$httpd->stop();
    }

    protected function setUp(): void
    {
        $this->http = new Client(['base_uri' => 'http://127.0.0.1:8080', 'timeout' => 2.0]);
    }

    protected function tearDown(): void
    {
        unset($this->http);
    }
}
