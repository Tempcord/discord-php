<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Parts\Role;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-role-create
 */
#[RequiresIntent(Intent::GUILDS)]
class GuildRoleCreate
{
    public string $guild_id;
    public Role $role;
}
