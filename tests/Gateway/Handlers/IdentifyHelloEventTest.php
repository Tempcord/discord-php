<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Gateway\Handlers;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Psr\Log\NullLogger;
use CyberWolf\Discord\DataMapper;
use CyberWolf\Discord\Gateway\ConnectionInterface;
use CyberWolf\Discord\Gateway\Handlers\IdentifyHelloEvent;
use CyberWolf\Discord\Gateway\Objects\Payload;

class IdentifyHelloEventTest extends MockeryTestCase
{
    private DataMapper $mapper;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapper = new DataMapper(new NullLogger());
    }

    public function testItAcknowledgesAHeartbeat(): void
    {
        /** @var MockInterface&ConnectionInterface */
        $connection = Mockery::mock(ConnectionInterface::class);
        $event = new IdentifyHelloEvent(
            $connection,
            $this->mapper->map((object) [
                'd' => (object) [
                    'heartbeat_interval' => 123
                ]
            ], Payload::class),
            new NullLogger(),
        );

        $connection->expects()
            ->identify()
            ->once();

        $connection->expects()
            ->sendHeartbeat()
            ->once();

        $connection->expects()
            ->startAutomaticHeartbeats()
            ->with(123)
            ->once();

        $event->execute();
    }
}
