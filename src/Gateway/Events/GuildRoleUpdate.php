<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Role;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-role-update
 */
#[RequiresIntent(Intent::GUILD_MEMBERS)]
class GuildRoleUpdate
{
    public string $guild_id;
    public Role $role;
}
