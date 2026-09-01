<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-role-delete
 */
#[RequiresIntent(Intent::GUILD_MEMBERS)]
class GuildRoleDelete
{
    public string $guild_id;
    public string $role_id;
}
