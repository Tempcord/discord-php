<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#webhooks-update
 */
#[RequiresIntent(Intent::GUILD_WEBHOOKS)]
class WebhooksUpdate
{
    public string $guild_id;
    public string $channel_id;
}
