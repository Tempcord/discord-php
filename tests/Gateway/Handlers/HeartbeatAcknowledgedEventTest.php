<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Gateway\Handlers;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Psr\Log\NullLogger;
use CyberWolf\Discord\Gateway\ConnectionInterface;
use CyberWolf\Discord\Gateway\Handlers\HeartbeatAcknowledgedEvent;
use CyberWolf\Discord\Gateway\Objects\Payload;

class HeartbeatAcknowledgedEventTest extends MockeryTestCase
{
    public function testItAcknowledgesAHeartbeat(): void
    {
        /** @var MockInterface&ConnectionInterface */
        $connection = Mockery::mock(ConnectionInterface::class);
        $event = new HeartbeatAcknowledgedEvent(
            $connection,
            Mockery::mock(Payload::class),
            new NullLogger(),
        );

        $this->assertEquals(true, $event->filter());

        $connection->expects()
            ->acknowledgeHeartbeat()
            ->once();

        $event->execute();
    }
}
