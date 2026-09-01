<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Gateway\Handlers;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Psr\Log\NullLogger;
use Tempcord\Discord\DataMapper;
use Tempcord\Discord\Gateway\ConnectionInterface;
use Tempcord\Discord\Gateway\Handlers\IdentifyResumeEvent;
use Tempcord\Discord\Gateway\Objects\Payload;

class IdentifyResumeEventTest extends MockeryTestCase
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
        $event = new IdentifyResumeEvent(
            $connection,
            $this->mapper->map((object) [
                'd' => (object) [
                    'heartbeat_interval' => 123
                ]
            ], Payload::class),
            new NullLogger(),
        );

        $connection->expects()
            ->resume()
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
