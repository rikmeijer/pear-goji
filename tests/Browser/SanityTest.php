<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\Browser;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

function proc_kill($process)
{
    if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
        $status = proc_get_status($process);
        return exec('taskkill /F /T /PID ' . $status['pid']);
    } else {
        return proc_terminate($process);
    }
}

class SanityTest extends TestCase
{
    public static $httpd;
    private Client $http;

    public static function setUpBeforeClass(): void
    {
        $root = dirname(dirname(__DIR__));
        $command = 'C:\php\7.4.6\php.exe -S 127.0.0.1:8080 -t ' . escapeshellarg($root . DIRECTORY_SEPARATOR . 'public');
        $descriptorspec = array(
            0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
            1 => array("pipe", sys_get_temp_dir() . DIRECTORY_SEPARATOR . "stdout.txt", "a"),  // stdout is a pipe that the child will write to
            2 => array("file", sys_get_temp_dir() . DIRECTORY_SEPARATOR . "error-output.txt", "a") // stderr is a file to write to
        );
        self::$httpd = proc_open($command, $descriptorspec, $pipes, $root);
    }

    public static function tearDownAfterClass(): void
    {
        proc_kill(self::$httpd);
        proc_close(self::$httpd);
    }

    public function testAPIAvailable(): void
    {
        $response = $this->http->get('/', []);
        $this->assertEquals(200, $response->getStatusCode());
        $json = json_decode($response->getBody()->getContents());
        $this->assertEquals('ok', $json->status);
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
