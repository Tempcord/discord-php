<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Handlers\Meta;

use Tempcord\Discord\Constants\GatewayCloseCodes;
use Tempcord\Discord\Gateway\Events\Meta\UnacknowledgedHeartbeatEvent as BaseUnacknowledgedHeartbeatEvent;

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
