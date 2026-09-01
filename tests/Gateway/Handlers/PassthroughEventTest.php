<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Gateway\Handlers;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Psr\Log\NullLogger;
use Tempcord\Discord\Constants\OpCodes;
use Tempcord\Discord\DataMapper;
use Tempcord\Discord\EventHandler;
use Tempcord\Discord\Gateway\ConnectionInterface;
use Tempcord\Discord\Gateway\Handlers\PassthroughEvent;
use Tempcord\Discord\Gateway\Objects\Payload;

class PassthroughEventTest extends MockeryTestCase
{
    private DataMapper $mapper;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapper = new DataMapper(new NullLogger());
    }
    public function testItListensTo11(): void
    {
        $this->assertEquals(OpCodes::EVENTS, PassthroughEvent::getEventName());
    }

    public function testItForwardsEvents(): void
    {
        /** @var MockInterface&ConnectionInterface */
        $connection = Mockery::mock(ConnectionInterface::class);
        $payload = $this->mapper->map((object) [], Payload::class);

        $event = new PassthroughEvent(
            $connection,
            $payload,
            new NullLogger(),
        );

        $connection->expects()
            ->getSequence()
            ->once();

        /** @var EventHandler&MockInterface */
        $eventHandler = Mockery::mock(EventHandler::class);
        $connection->expects()
            ->getEventHandler()
            ->andReturns($eventHandler)
            ->once();

        $eventHandler->expects()
            ->handle()
            ->with($payload)
            ->once();

        $event->execute();
    }

    public function testItUpdatesSequence(): void
    {
        /** @var MockInterface&ConnectionInterface */
        $connection = Mockery::mock(ConnectionInterface::class);
        $payload = $this->mapper->map((object) ['s' => 123], Payload::class);

        $event = new PassthroughEvent(
            $connection,
            $payload,
            new NullLogger(),
        );

        $connection->expects()
            ->getSequence()
            ->once();

        /** @var EventHandler&MockInterface */
        $eventHandler = Mockery::mock(EventHandler::class);
        $connection->expects()
            ->getEventHandler()
            ->andReturns($eventHandler)
            ->once();

        $eventHandler->expects()
            ->handle()
            ->with($payload)
            ->once();

        $connection->expects()
            ->setSequence()
            ->with(123)
            ->once();

        $event->execute();
    }

    public function testItDoesNotUpdateSequenceIfCurrentSequenceIsHigherThanIncoming(): void
    {
        /** @var MockInterface&ConnectionInterface */
        $connection = Mockery::mock(ConnectionInterface::class);
        $payload = $this->mapper->map((object) ['s' => 123], Payload::class);

        $event = new PassthroughEvent(
            $connection,
            $payload,
            new NullLogger(),
        );

        $connection->expects()
            ->getSequence()
            ->andReturns(456)
            ->once();

        /** @var EventHandler&MockInterface */
        $eventHandler = Mockery::mock(EventHandler::class);
        $connection->expects()
            ->getEventHandler()
            ->andReturns($eventHandler)
            ->once();

        $eventHandler->expects()
            ->handle()
            ->with($payload)
            ->once();

        $connection->expects()
            ->setSequence()
            ->with(123)
            ->never();

        $event->execute();
    }

    public function testItSetsSequenceIfNoCurrentSequenceIsSet(): void
    {
        /** @var MockInterface&ConnectionInterface */
        $connection = Mockery::mock(ConnectionInterface::class);
        $payload = $this->mapper->map((object) ['s' => 123], Payload::class);

        $event = new PassthroughEvent(
            $connection,
            $payload,
            new NullLogger(),
        );

        $connection->expects()
            ->getSequence()
            ->andReturns(null)
            ->once();

        /** @var EventHandler&MockInterface */
        $eventHandler = Mockery::mock(EventHandler::class);
        $connection->expects()
            ->getEventHandler()
            ->andReturns($eventHandler)
            ->once();

        $eventHandler->expects()
            ->handle()
            ->with($payload)
            ->once();

        $connection->expects()
            ->setSequence()
            ->with(123)
            ->once();

        $event->execute();
    }
}
