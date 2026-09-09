<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Message;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#message-update
 */
#[RequiresIntent(Intent::GUILD_MESSAGES)]
#[RequiresIntent(Intent::DIRECT_MESSAGES)]
class MessageUpdate extends Message
{
    public ?string $guild_id = null;

    /** The cached message immediately before Discord applied this edit. */
    public ?Message $oldMessage = null;

    /** The cached message after this edit was merged into it. */
    public ?Message $newMessage = null;
}
