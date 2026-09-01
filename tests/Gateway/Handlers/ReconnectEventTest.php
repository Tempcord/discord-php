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
use Tempcord\Discord\Gateway\Handlers\ReconnectEvent;
use Tempcord\Discord\Gateway\Objects\Payload;

class ReconnectEventTest extends MockeryTestCase
{
    private DataMapper $mapper;
    private ConnectionInterface&MockInterface $connectionInterface;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapper = new DataMapper(new NullLogger());
        $this->connectionInterface = Mockery::mock(ConnectionInterface::class);
    }

    public function testItDisconnectsWithCorrectCode(): void
    {
        $event = new ReconnectEvent(
            $this->connectionInterface,
            $this->mapper->map((object) [], Payload::class),
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
