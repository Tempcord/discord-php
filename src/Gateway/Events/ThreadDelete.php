<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#thread-delete
 */
#[RequiresIntent(Intent::GUILDS)]
class ThreadDelete
{
    public string $id;
    public ?string $guild_id;
    public ?string $parent_id;
    public int $type;
}
