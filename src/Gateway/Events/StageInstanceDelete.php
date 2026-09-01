<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#stage-instance-delete
 */
#[RequiresIntent(Intent::GUILDS)]
class StageInstanceDelete
{
    public string $token;
    public string $guild_id;
    public ?string $endpoint;
}
