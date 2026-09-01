<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\MembershipState;

class TeamMember
{
    public MembershipState $membership_state;
    /**
     * @var string[]
     */
    public array $permissions;
    public string $team_id;
    public User $user;
}
