<?php declare(strict_types=1);


namespace rikmeijer\𓀁\tests;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriver;
use PHPUnit\Framework\TestCase;

abstract class BrowserTest extends TestCase
{
    public static Server $httpd;
    public static $geckodriver;
    public static array $geckodriverPipes = [];

    public static WebDriver $driver;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        $root = dirname(__DIR__);

        self::$httpd = new Server($_ENV['PHP_BINARY'], $_ENV['PHP_SERVER_ADDRESS']);
        self::$httpd->start(dirname(__DIR__));

        self::$geckodriver = proc_open($_ENV['GECKODRIVER_BIN'], [
            0 => ["pipe", "r"],
            1 => ["pipe", "a"],
            2 => ["pipe", "a"]
        ], self::$geckodriverPipes, $root);

        self::$driver = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::firefox());
    }

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public static function tearDownAfterClass(): void
    {
        self::$driver->close();

        parent::tearDownAfterClass();
        self::$httpd->stop();

        self::proc_kill(self::$geckodriver);
        proc_close(self::$geckodriver);
    }

    public static function proc_kill($process): bool
    {
        if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
            $status = proc_get_status($process);
            exec('taskkill /F /T /PID ' . $status['pid']);
            return true;
        } else {
            return proc_terminate($process);
        }
    }
}
