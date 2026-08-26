<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Parts\GuildScheduledEvent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-scheduled-event-create
 */
#[RequiresIntent(Intent::GUILD_SCHEDULED_EVENTS)]
class GuildScheduledEventCreate extends GuildScheduledEvent
{
}
