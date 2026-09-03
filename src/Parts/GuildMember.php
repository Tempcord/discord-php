<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;

class GuildMember
{
    public ?User $user = null;
    public ?string $nick = null;
    public ?string $avatar = null;
    /**
     * @var string[]
     */
    public array $roles;
    public Carbon $joined_at;
    public ?Carbon $premium_since = null;
    public bool $deaf;
    public bool $mute;
    public int $flags;
    public ?bool $pending = null;
    public ?string $permissions = null;
    public ?Carbon $communication_disabled_until = null;
}
