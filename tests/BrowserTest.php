<?php declare(strict_types=1);


namespace rikmeijer\𓀁\tests;

use PHPUnit\Extensions\Selenium2TestCase;

abstract class BrowserTest extends Selenium2TestCase
{
    public static Server $httpd;
    public static $selenium;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        $root = dirname(__DIR__);

        self::$httpd = new Server();
        self::$httpd->start(dirname(__DIR__));


        self::$selenium = proc_open('java -jar C:\php\selenium-server-standalone-3.141.59.jar', array(
            0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
            1 => array("pipe", sys_get_temp_dir() . DIRECTORY_SEPARATOR . "selenium-stdout.txt", "a"),  // stdout is a pipe that the child will write to
            2 => array("file", sys_get_temp_dir() . DIRECTORY_SEPARATOR . "selenium-error-output.txt", "a") // stderr is a file to write to
        ), $seleniumPipes, $root);
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
