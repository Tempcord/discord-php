<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Mapping\ArrayMapping;
use CyberWolf\Discord\Parts\GuildMember;
use CyberWolf\Discord\Parts\Message;
use CyberWolf\Discord\Parts\User;

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
    public ?string $guild_id;
    public ?GuildMember $member;
}
