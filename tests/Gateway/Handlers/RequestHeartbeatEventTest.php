<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Gateway\Handlers;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Psr\Log\NullLogger;
use Tempcord\Discord\Constants\OpCodes;
use Tempcord\Discord\Gateway\ConnectionInterface;
use Tempcord\Discord\Gateway\Handlers\RequestHeartbeatEvent;
use Tempcord\Discord\Gateway\Objects\Payload;

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
