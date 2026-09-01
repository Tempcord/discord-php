<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\User;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-ban-add
 */
#[RequiresIntent(Intent::GUILD_MODERATION)]
class GuildBanAdd
{
    public string $guild_id;
    public User $user;
}
