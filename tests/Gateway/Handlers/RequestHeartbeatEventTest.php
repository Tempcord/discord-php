<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Gateway\Handlers;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Psr\Log\NullLogger;
use CyberWolf\Discord\Constants\OpCodes;
use CyberWolf\Discord\Gateway\ConnectionInterface;
use CyberWolf\Discord\Gateway\Handlers\RequestHeartbeatEvent;
use CyberWolf\Discord\Gateway\Objects\Payload;

class RequestHeartbeatEventTest extends MockeryTestCase
{
    public function testItAcknowledgesAHeartbeat(): void
    {
        /** @var MockInterface&ConnectionInterface */
        $connection = Mockery::mock(ConnectionInterface::class);
        $event = new RequestHeartbeatEvent(
            $connection,
            Mockery::mock(Payload::class),
            new NullLogger(),
        );

        $connection->expects()
            ->sendHeartbeat()
            ->once();

        $event->execute();
    }
}
