<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;
use Tempcord\Discord\Bitwise\Bitwise;

class ThreadMember
{
    public ?string $id;
    public ?string $user_id;
    public Carbon $join_timestamp;
    public Bitwise $flags;
    public ?GuildMember $member;
}
