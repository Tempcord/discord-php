<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Attributes\Partial;
use Tempcord\Discord\Mapping\ArrayMapping;

class InteractionDataResolved
{
    /**
     * Array of string => User
     * @var User[]
     */
    #[ArrayMapping(User::class)]
    public ?array $users = null;
    /**
     * Array of string => GuildMember
     * @var GuildMember[]
     */
    #[ArrayMapping(GuildMember::class)]
    public ?array $members = null;
    /**
     * Array of string => Role
     * @var Role[]
     */
    #[ArrayMapping(Role::class)]
    public ?array $roles = null;
    /**
     * Array of string => Channel
     * @var Channel[]
     */
    #[ArrayMapping(Channel::class)]
    public ?array $channels = null;
    /**
     * Array of string => Message
     * @var Message[]
     */
    #[ArrayMapping(Message::class)]
    public ?array $messages = null;
    /**
     * Array of string => Attachment
     * @var Attachment[]
     */
    #[ArrayMapping(Attachment::class)]
    public ?array $attachments = null;
}
