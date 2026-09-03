<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Carbon\Carbon;
use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\User;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-member-update
 */
#[RequiresIntent(Intent::GUILD_MEMBERS)]
class GuildMemberUpdate
{
    public string $guild_id;

    /**
     * @var string[]
     */
    public array $roles;

    public User $user;
    public ?string $nick = null;
    public ?string $avatar = null;
    public ?Carbon $joined_at = null;
    public ?Carbon $premium_since = null;
    public ?bool $deaf = null;
    public ?bool $mute = null;
    public ?bool $pending = null;
    public ?Carbon $communication_disabled_until = null;
}
