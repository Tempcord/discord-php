<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Parts\GuildMember;
use Tempcord\Discord\Parts\Message;
use Tempcord\Discord\Parts\User;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#message-create
 */
#[RequiresIntent(Intent::MESSAGE_CONTENT)]
#[RequiresIntent(Intent::GUILD_MESSAGES)]
#[RequiresIntent(Intent::DIRECT_MESSAGES)]
class MessageCreate extends Message
{
    /**
     * @var User[]
     */
    #[ArrayMapping(User::class)]
    public array $mentions;
    public ?string $guild_id = null;
    public ?GuildMember $member = null;
}
