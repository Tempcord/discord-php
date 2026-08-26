<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#stage-instance-create
 */
#[RequiresIntent(Intent::GUILDS)]
class StageInstanceCreate
{
    public string $token;
    public string $guild_id;
    public ?string $endpoint;
}
