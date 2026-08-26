<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-role-delete
 */
#[RequiresIntent(Intent::GUILD_MEMBERS)]
class GuildRoleDelete
{
    public string $guild_id;
    public string $role_id;
}
