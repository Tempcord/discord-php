<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Handlers;

use CyberWolf\Discord\Constants\OpCodes;

class RequestHeartbeatEvent extends GatewayEvent
{
    public static function getEventName(): string
    {
        return OpCodes::HEARTBEAT;
    }

    public function execute(): void
    {
        $this->connection->sendHeartbeat();
    }
}
