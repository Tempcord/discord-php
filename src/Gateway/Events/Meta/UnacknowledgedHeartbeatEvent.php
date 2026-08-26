<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events\Meta;

use CyberWolf\Discord\Constants\MetaEvents;

abstract class UnacknowledgedHeartbeatEvent extends MetaEvent
{
    public static function getEventName(): string
    {
        return MetaEvents::UNACKNOWLEDGED_HEARTBEAT;
    }
}
