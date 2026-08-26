<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

class GuildBan
{
    public ?string $reason;
    public User $user;
}
