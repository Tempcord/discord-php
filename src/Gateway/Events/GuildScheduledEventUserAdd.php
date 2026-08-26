<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-scheduled-event-user-add
 */
#[RequiresIntent(Intent::GUILD_SCHEDULED_EVENTS)]
class GuildScheduledEventUserAdd
{
    public string $guild_scheduled_event_id;
    public string $user_id;
    public string $guild_id;
}
