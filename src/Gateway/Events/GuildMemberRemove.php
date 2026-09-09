<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\GuildMember;
use Tempcord\Discord\Parts\User;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-member-remove
 */
#[RequiresIntent(Intent::GUILD_MEMBERS)]
class GuildMemberRemove
{
    public string $guild_id;
    public User $user;

    /**
     * The cached member immediately before it was removed.
     *
     * A leave payload itself contains only a User. Tempcord fills this before
     * evicting the cache entry, which preserves the member's join time, roles
     * and timeout state for leave and kick listeners.
     */
    public ?GuildMember $oldMember = null;
}
