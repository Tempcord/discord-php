<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Gateway\Handlers;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Psr\Log\NullLogger;
use CyberWolf\Discord\Constants\GatewayCloseCodes;
use CyberWolf\Discord\DataMapper;
use CyberWolf\Discord\Gateway\ConnectionInterface;
use CyberWolf\Discord\Gateway\Handlers\RecoverableInvalidSessionEvent;
use CyberWolf\Discord\Gateway\Objects\Payload;

class RecoverableInvalidSessionEventTest extends MockeryTestCase
{
    private DataMapper $mapper;
    private ConnectionInterface&MockInterface $connectionInterface;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapper = new DataMapper(new NullLogger());
        $this->connectionInterface = Mockery::mock(ConnectionInterface::class);
    }

    /**
     * @dataProvider listenerDataProvider
     */
    public function testItListensToTheCorrectRequirements(object $payload, bool $expect): void
    {
        $event = new RecoverableInvalidSessionEvent(
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
                'expect' => true,
            ],
            'Payload D => false' => [
                'payload' => (object) [
                    'd' => false
                ],
                'expect' => false,
            ]
        ];
    }

    public function testItDisconnectsWithCorrectCode(): void
    {
        $event = new RecoverableInvalidSessionEvent(
            $this->connectionInterface,
            $this->mapper->map((object) ['d' => true], Payload::class),
            new NullLogger(),
        );

        $this->connectionInterface
            ->shouldReceive()
            ->disconnect()
            ->with(GatewayCloseCodes::LIB_INSTANTIATED_RESUME, Mockery::type('string'))
            ->once();

        $event->execute();
    }
}
