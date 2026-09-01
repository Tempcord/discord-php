<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Channel;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#channel-update
 */
#[RequiresIntent(Intent::GUILDS)]
class ChannelUpdate extends Channel
{
}
