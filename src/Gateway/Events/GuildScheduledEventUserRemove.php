<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-scheduled-event-user-remove
 */
#[RequiresIntent(Intent::GUILD_SCHEDULED_EVENTS)]
class GuildScheduledEventUserRemove
{
    public string $guild_scheduled_event_id;
    public string $user_id;
    public string $guild_id;
}
