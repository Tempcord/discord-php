<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Handlers;

use Tempcord\Discord\Constants\GatewayCloseCodes;
use Tempcord\Discord\Constants\OpCodes;

class ReconnectEvent extends GatewayEvent
{
    public static function getEventName(): string
    {
        return OpCodes::RECONNECT;
    }

    public function execute(): void
    {
        $this->connection->disconnect(
            GatewayCloseCodes::LIB_INSTANTIATED_RESUME,
            'Received opcode 7, attempting resume'
        );
    }
}
