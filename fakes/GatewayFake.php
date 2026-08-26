<?php

declare(strict_types=1);

namespace Fakes\CyberWolf\Discord;

use Exan\Eventer\Eventer;
use Fakes\CyberWolf\Discord\DataMapperFake;
use CyberWolf\Discord\EventHandler;
use CyberWolf\Discord\Websocket;
use Mockery;
use Mockery\MockInterface;
use CyberWolf\Discord\Gateway\Connection;

class GatewayFake
{
    /**
     * Returns a partially mocked Gateway instance.
     *  `$gateway->events` is a real `EventHandler` as events
     *  can be emitted with `->emit`. This is often more convenient
     *  than a mock implementation.
     */
    public static function get(): Connection&MockInterface
    {
        /** @var Connection&MockInterface */
        $gateway = Mockery::mock(Connection::class);

        $gateway->events = new EventHandler(DataMapperFake::get());
        $gateway->raw = new Eventer();

        return $gateway;
    }
}
