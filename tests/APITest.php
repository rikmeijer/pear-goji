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
        self::$httpd = new Server($_ENV['PHP_BINARY'], $_ENV['PHP_SERVER_ADDRESS']);
        self::$httpd->start(dirname(__DIR__));
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        self::$httpd->stop();
    }

    protected function setUp(): void
    {
        $this->http = new Client(['base_uri' => $_ENV['PHP_SERVER_ADDRESS'], 'timeout' => 2.0]);
    }

    protected function tearDown(): void
    {
        unset($this->http);
    }
}
