<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Handlers;

use Tempcord\Discord\Constants\OpCodes;

abstract class IdentifyEvent extends GatewayEvent
{
    public static function getEventName(): string
    {
        return OpCodes::HELLO;
    }

    public function execute(): void
    {
        $this->connection->sendHeartbeat();

        $this->connection->startAutomaticHeartbeats($this->payload->d->heartbeat_interval);
    }
}
