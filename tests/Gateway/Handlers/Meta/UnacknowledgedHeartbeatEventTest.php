<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Gateway\Handlers\Meta;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Psr\Log\NullLogger;
use Tempcord\Discord\Constants\GatewayCloseCodes;
use Tempcord\Discord\Constants\MetaEvents;
use Tempcord\Discord\Gateway\ConnectionInterface;
use Tempcord\Discord\Gateway\Handlers\Meta\UnacknowledgedHeartbeatEvent;

class UnacknowledgedHeartbeatEventTest extends MockeryTestCase
{
    public function testItListensToUnacknowledgedHeartbeat(): void
    {
        $this->assertEquals(MetaEvents::UNACKNOWLEDGED_HEARTBEAT, UnacknowledgedHeartbeatEvent::getEventName());
    }

    public function testItDisconnectsWithRightCode(): void
    {
        $connection = Mockery::mock(ConnectionInterface::class);

        $event = new UnacknowledgedHeartbeatEvent(
            $connection,
            new NullLogger()
        );

        $connection
            ->shouldReceive()
            ->disconnect()
            ->with(GatewayCloseCodes::LIB_INSTANTIATED_RECONNECT, Mockery::type('string'))
            ->once();

        $event->execute();
    }
}
