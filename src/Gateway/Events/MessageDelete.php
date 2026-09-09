<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Message;

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

    /** The cached message before it was removed, or null after a cold start. */
    public ?Message $oldMessage = null;
}
