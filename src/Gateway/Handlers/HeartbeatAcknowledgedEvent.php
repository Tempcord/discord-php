<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Handlers;

use CyberWolf\Discord\Constants\OpCodes;

class HeartbeatAcknowledgedEvent extends GatewayEvent
{
    public static function getEventName(): string
    {
        return OpCodes::HEARTBEAT_ACKNOWLEDGEMENT;
    }

    public function execute(): void
    {
        $this->connection->acknowledgeHeartbeat();
    }
}
