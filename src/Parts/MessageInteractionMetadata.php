<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\InteractionType;

class MessageInteractionMetadata
{
    public string $id;
    public InteractionType $type;
    public string $name;
    public User $user;
    public ?GuildMember $member;
}
