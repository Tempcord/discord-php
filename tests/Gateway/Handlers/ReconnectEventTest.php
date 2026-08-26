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
use CyberWolf\Discord\Gateway\Handlers\ReconnectEvent;
use CyberWolf\Discord\Gateway\Objects\Payload;

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
