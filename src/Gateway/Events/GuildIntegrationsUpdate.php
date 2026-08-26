<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-integrations-update
 */
#[RequiresIntent(Intent::GUILD_INTEGRATIONS)]
class GuildIntegrationsUpdate
{
    public string $guild_id;
}
