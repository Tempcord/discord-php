<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\GuildScheduledEvent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-scheduled-event-delete
 */
#[RequiresIntent(Intent::GUILD_SCHEDULED_EVENTS)]
class GuildScheduledEventDelete extends GuildScheduledEvent
{
}
