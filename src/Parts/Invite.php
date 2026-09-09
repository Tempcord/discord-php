<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;
use Tempcord\Discord\Enums\InviteTargetType;

class Invite
{
    public string $code;
    public ?Guild $guild = null;
    public ?Channel $channel = null;
    public ?User $inviter = null;
    public ?InviteTargetType $target_type = null;
    public ?User $target_user = null;
    public ?Application $target_application = null;
    /** Number of times this invite has been used. Available from guild invite lists. */
    public ?int $uses = null;
    /** Maximum permitted uses for this invite. Zero means unlimited. */
    public ?int $max_uses = null;
    /** Maximum age in seconds. Zero means this invite does not expire. */
    public ?int $max_age = null;
    public ?bool $temporary = null;
    public ?Carbon $created_at = null;
    public ?int $approximate_presence_count = null;
    public ?int $approximate_member_count = null;
    public ?Carbon $expires_at = null;
    public ?InviteStageInstanceObject $stage_instance = null;
    public ?GuildScheduledEvent $guild_scheduled_event = null;
}
