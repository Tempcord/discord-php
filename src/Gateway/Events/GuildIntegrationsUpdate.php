<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-integrations-update
 */
#[RequiresIntent(Intent::GUILD_INTEGRATIONS)]
class GuildIntegrationsUpdate
{
    public string $guild_id;
}
