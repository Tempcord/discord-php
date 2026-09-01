<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events\Meta;

use Tempcord\Discord\Constants\MetaEvents;

abstract class UnacknowledgedHeartbeatEvent extends MetaEvent
{
    public static function getEventName(): string
    {
        return MetaEvents::UNACKNOWLEDGED_HEARTBEAT;
    }
}
