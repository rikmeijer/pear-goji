<?php declare(strict_types=1);


namespace rikmeijer\𓀁\tests;

use PHPUnit\Extensions\Selenium2TestCase;

class BrowserTest extends Selenium2TestCase
{
    public static $httpd;
    public static $selenium;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        $root = dirname(__DIR__);
        $command = 'C:\php\7.4.6\php.exe -S 127.0.0.1:8080 -t ' . escapeshellarg($root . DIRECTORY_SEPARATOR . 'public');
        self::$httpd = proc_open($command, array(
            0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
            1 => array("pipe", sys_get_temp_dir() . DIRECTORY_SEPARATOR . "stdout.txt", "a"),  // stdout is a pipe that the child will write to
            2 => array("file", sys_get_temp_dir() . DIRECTORY_SEPARATOR . "error-output.txt", "a") // stderr is a file to write to
        ), $httpdPipes, $root);


        self::$selenium = proc_open('"C:\Program Files\Java\jdk-14.0.1\bin\java.exe" -jar C:\php\selenium-server-standalone-3.141.59.jar', array(
            0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
            1 => array("pipe", sys_get_temp_dir() . DIRECTORY_SEPARATOR . "selenium-stdout.txt", "a"),  // stdout is a pipe that the child will write to
            2 => array("file", sys_get_temp_dir() . DIRECTORY_SEPARATOR . "selenium-error-output.txt", "a") // stderr is a file to write to
        ), $seleniumPipes, $root);
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        self::proc_kill(self::$httpd);
        proc_close(self::$httpd);

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
