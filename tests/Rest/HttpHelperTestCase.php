<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest;

use Discord\Http\Http;
use Tempcord\Discord\DataMapper;
use Tempcord\Discord\Rest\HttpResource;
use Fakes\Tempcord\Discord\DataMapperFake;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use React\Promise\Promise;
use PHPUnit\Framework\Attributes\DataProvider;

use function React\Async\await;

abstract class HttpHelperTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected HttpResource $httpItem;

    protected Http $http;

    protected DataMapper $dataMapper;

    protected LoggerInterface $mockLog;

    protected string $httpItemClass;

    protected function setUp(): void
    {
        $this->http = Mockery::mock(Http::class);

        $this->dataMapper = DataMapperFake::get();

        $this->mockLog = Mockery::mock(LoggerInterface::class);

        $this->httpItem = new $this->httpItemClass($this->http, $this->dataMapper, $this->mockLog);
    }

    abstract public static function httpBindingsProvider(): array;

    #[DataProvider('httpBindingsProvider')]
    public function testFunctions(string $method, array $args, array $mockOptions, array $validationOptions): void
    {
        $requestedUrl = null;

        $this->http->shouldReceive($mockOptions['method'])
            ->withArgs(static function ($url, ...$rest) use (&$requestedUrl) {
                $requestedUrl = (string) $url;

                return true;
            })
            ->andReturns(
                new Promise(static function ($resolve) use ($mockOptions) {
                    $resolve($mockOptions['return']);
                })
            )->once();

        $response = await(call_user_func_array([$this->httpItem, $method], $args));

        $this->http->shouldHaveReceived($mockOptions['method']);

        /*
         * Optional, and worth filling in: nothing here checked which endpoint a
         * method actually called, so a method binding the wrong Endpoint
         * constant passed its test while never once reaching the route it was
         * named after.
         */
        if (isset($validationOptions['url'])) {
            $this->assertSame($validationOptions['url'], $requestedUrl);
        }

        if (!isset($validationOptions['returnType'])) {
            return;
        }

        if (isset($validationOptions['array']) && $validationOptions['array'] === true) {
            foreach ($response as $item) {
                $this->assertInstanceOf($validationOptions['returnType'], $item);
            }
        } else {
            $this->assertInstanceOf($validationOptions['returnType'], $response);
        }
    }
}
