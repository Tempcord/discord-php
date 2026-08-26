<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Parts\GuildMember;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-member-add
 */
#[RequiresIntent(Intent::GUILD_MEMBERS)]
class GuildMemberAdd extends GuildMember
{
    public string $guild_id;
}
