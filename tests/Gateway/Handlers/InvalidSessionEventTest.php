<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Gateway\Handlers;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Psr\Log\NullLogger;
use Tempcord\Discord\Constants\GatewayCloseCodes;
use Tempcord\Discord\DataMapper;
use Tempcord\Discord\Gateway\ConnectionInterface;
use Tempcord\Discord\Gateway\Handlers\InvalidSessionEvent;
use Tempcord\Discord\Gateway\Objects\Payload;
use PHPUnit\Framework\Attributes\DataProvider;

class InvalidSessionEventTest extends MockeryTestCase
{
    private DataMapper $mapper;
    private ConnectionInterface&MockInterface $connectionInterface;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapper = new DataMapper(new NullLogger());
        $this->connectionInterface = Mockery::mock(ConnectionInterface::class);
    }

    #[DataProvider('listenerDataProvider')]
    public function testItListensToTheCorrectRequirements(object $payload, bool $expect): void
    {
        $event = new InvalidSessionEvent(
            Mockery::mock(ConnectionInterface::class),
            $this->mapper->map($payload, Payload::class),
            new NullLogger(),
        );

        $this->assertEquals($expect, $event->filter());
    }

    public static function listenerDataProvider(): array
    {
        return [
            'Payload D => true' => [
                'payload' => (object) [
                    'd' => true
                ],
                'expect' => false,
            ],
            'Payload D => false' => [
                'payload' => (object) [
                    'd' => false
                ],
                'expect' => true,
            ]
        ];
    }

    public function testItDisconnectsWithCorrectCode(): void
    {
        $event = new InvalidSessionEvent(
            $this->connectionInterface,
            $this->mapper->map((object) ['d' => true], Payload::class),
            new NullLogger(),
        );

        $this->connectionInterface
            ->shouldReceive()
            ->disconnect()
            ->with(GatewayCloseCodes::LIB_INSTANTIATED_RECONNECT, Mockery::type('string'))
            ->once();

        $event->execute();
    }
}
