<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#message-delete
 */
#[RequiresIntent(Intent::GUILD_MESSAGES)]
#[RequiresIntent(Intent::DIRECT_MESSAGES)]
class MessageDelete
{
    public string $id;
    public string $channel_id;
    public ?string $guild_id = null;
}
