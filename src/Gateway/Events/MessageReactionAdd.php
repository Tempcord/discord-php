<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Emoji;
use Tempcord\Discord\Parts\GuildMember;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#message-reaction-add
 */
#[RequiresIntent(Intent::GUILD_MESSAGE_REACTIONS)]
#[RequiresIntent(Intent::DIRECT_MESSAGE_REACTIONS)]
class MessageReactionAdd
{
    public string $user_id;
    public string $channel_id;
    public string $message_id;
    public ?string $guild_id = null;
    public ?GuildMember $member = null;
    public Emoji $emoji;
}
