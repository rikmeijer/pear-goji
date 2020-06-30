<?php declare(strict_types=1);

namespace rikmeijer\𓀁\tests\Unit;

use PHPUnit\Framework\TestCase;
use rikmeijer\Bootstrap\Bootstrap;
use Symfony\Component\Routing\Exception\NoConfigurationException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

final class BootstrapTest extends TestCase
{
    private string $configurationPath;
    private Bootstrap $object;

    public function setUp(): void
    {
        $this->configurationPath = dirname(__DIR__, 2);
        rename(
            $this->configurationPath . DIRECTORY_SEPARATOR . 'config.defaults.php',
            $this->configurationPath . DIRECTORY_SEPARATOR . 'TESTING-config.defaults.php'
        );
        $this->object = require $this->configurationPath . DIRECTORY_SEPARATOR . 'bootstrap.php';
    }

    /**
     * @test
     */
    public function Routes_WhenNoRoutesConfigured_ExpectError(): void
    {
        $this->expectException(NoConfigurationException::class);
        $matcher = $this->object->resource('routes')->createMatcherForRequestContext(new RequestContext('/'));
        $this->assertInstanceOf(UrlMatcher::class, $matcher);

        $parameters = $matcher->match('/');

        $this->assertEquals(self::class, $parameters['_controller']);
        $this->assertEquals('index', $parameters['_route']);
    }

    /**
     * @test
     */
    public function Routes_WhenRouteConfigured_ExpectMatcherMatchingRoute(): void
    {
        file_put_contents(
            $this->configurationPath . DIRECTORY_SEPARATOR . 'config.defaults.php',
            '<?php return ' . var_export(
                [
                    'routes' => ['index' => ['/', self::class]]
                ],
                true
            ) . ';'
        );

        $matcher = $this->object->resource('routes')->createMatcherForRequestContext(new RequestContext('/'));
        $this->assertInstanceOf(UrlMatcher::class, $matcher);

        $parameters = $matcher->match('/');

        $this->assertEquals(self::class, $parameters['_controller']);
        $this->assertEquals('index', $parameters['_route']);
    }

    /**
     * @test
     */
    public function Routes_WhenRouteWithMultipleMethodsConfigured_ExpectMatcherMatchingRouteByMethod(): void
    {
        file_put_contents(
            $this->configurationPath . DIRECTORY_SEPARATOR . 'config.defaults.php',
            '<?php return ' . var_export(
                [
                    'routes' => [
                        'index' => [
                            '/',
                            [
                                'GET' => self::class . 'Get',
                                'POST' => self::class . 'Post'
                            ]
                        ]
                    ]

                ],
                true
            ) . ';'
        );

        $routes = $this->object->resource('routes');

        $matcher = $routes->createMatcherForRequestContext(new RequestContext('/'));
        $this->assertInstanceOf(UrlMatcher::class, $matcher);

        $parameters = $matcher->match('/');

        $this->assertEquals(self::class . 'Get', $parameters['_controller']);
        $this->assertEquals('GET-index', $parameters['_route']);


        $matcher = $routes->createMatcherForRequestContext(new RequestContext('/', 'POST'));
        $this->assertInstanceOf(UrlMatcher::class, $matcher);

        $parameters = $matcher->match('/');

        $this->assertEquals(self::class . 'Post', $parameters['_controller']);
        $this->assertEquals('POST-index', $parameters['_route']);
    }

    protected function tearDown(): void
    {
        rename(
            $this->configurationPath . DIRECTORY_SEPARATOR . 'TESTING-config.defaults.php',
            $this->configurationPath . DIRECTORY_SEPARATOR . 'config.defaults.php'
        );
    }
}
