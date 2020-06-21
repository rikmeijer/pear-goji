<?php declare(strict_types=1);


namespace rikmeijer\𓀁\tests;

use PHPUnit\Extensions\Selenium2TestCase;

abstract class BrowserTest extends Selenium2TestCase
{
    public static Server $httpd;
    public static $selenium;
    public static array $seleniumPipes = [];

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        $root = dirname(__DIR__);

        self::$httpd = new Server($_ENV['PHP_BINARY'], $_ENV['PHP_SERVER_ADDRESS']);
        self::$httpd->start(dirname(__DIR__));


        self::$selenium = proc_open($_ENV['JAVA_BIN'] . ' -jar ' . $_ENV['SELENIUM_JAR'], [
            0 => ["pipe", "r"],
            1 => ["pipe", "a"],
            2 => ["pipe", "a"]
        ], self::$seleniumPipes, $root);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        self::$httpd->stop();

        self::proc_kill(self::$selenium);
        proc_close(self::$selenium);
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
