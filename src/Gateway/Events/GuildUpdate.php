<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Guild;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-update
 */
#[RequiresIntent(Intent::GUILDS)]
class GuildUpdate extends Guild
{
}
