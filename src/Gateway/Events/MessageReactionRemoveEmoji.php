<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Emoji;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#message-reaction-remove-emoji
 */
#[RequiresIntent(Intent::GUILD_MESSAGE_REACTIONS)]
#[RequiresIntent(Intent::DIRECT_MESSAGE_REACTIONS)]
class MessageReactionRemoveEmoji
{
    public string $channel_id;
    public ?string $guild_id = null;
    public string $message_id;
    public Emoji $emoji;
}
