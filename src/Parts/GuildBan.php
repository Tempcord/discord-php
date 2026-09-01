<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class GuildBan
{
    public ?string $reason;
    public User $user;
}
