<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Handlers\Meta;

use CyberWolf\Discord\Constants\GatewayCloseCodes;
use CyberWolf\Discord\Gateway\Events\Meta\UnacknowledgedHeartbeatEvent as BaseUnacknowledgedHeartbeatEvent;

class UnacknowledgedHeartbeatEvent extends BaseUnacknowledgedHeartbeatEvent
{
    public function execute(): void
    {
        $this->connection->disconnect(
            GatewayCloseCodes::LIB_INSTANTIATED_RECONNECT,
            'Unacknowledged heartbeat, attempting reconnect'
        );
    }
}
