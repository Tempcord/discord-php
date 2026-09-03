<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\InteractionType;

class MessageInteractionMetadata
{
    public string $id;
    public InteractionType $type;
    public string $name;
    public User $user;
    public ?GuildMember $member = null;
}
