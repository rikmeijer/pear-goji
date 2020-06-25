<?php /** @noinspection GlobalVariableUsageInspection */
declare(strict_types=1);


namespace rikmeijer\𓀁\tests;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriver;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use tidy;

abstract class BrowserTest extends TestCase
{
    public static Server $httpd;
    public static $geckodriver;
    public static array $geckodriverPipes = [];

    public static WebDriver $driver;
    private Client $http;

    final public static function setUpBeforeClass(): void
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

    final protected function setUp(): void
    {
        parent::setUp();
        $this->http = new Client(['base_uri' => $_ENV['PHP_SERVER_ADDRESS'], 'timeout' => 2.0]);
    }

    final protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->http);
    }

    final public static function tearDownAfterClass(): void
    {
        self::$driver->close();

        parent::tearDownAfterClass();
        self::$httpd->stop();

        if (strncasecmp(PHP_OS, 'WIN', 3) !== 0) {
            proc_terminate(self::$geckodriver);
        } else {
            $status = proc_get_status(self::$geckodriver);
            exec('taskkill /F /T /PID ' . $status['pid']);
        }

        proc_close(self::$geckodriver);
    }

    final protected function visit(string $path): object
    {
        self::$driver->navigate()->to($_ENV['PHP_SERVER_ADDRESS'] . $path);
        return new class(self::$driver, $this->http->get($path)) {
            private WebDriver $driver;
            private ResponseInterface $response;

            public function __construct(WebDriver $driver, ResponseInterface $response)
            {
                $this->driver = $driver;
                $this->response = $response;
            }

            final public function validate(): string
            {
                $tidy = new tidy();
                $tidy->parseString($this->response->getBody()->getContents(), [], 'utf8');
                return $tidy->errorBuffer;
            }
        };
    }
}
