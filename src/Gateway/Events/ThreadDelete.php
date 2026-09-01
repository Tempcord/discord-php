<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;

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
