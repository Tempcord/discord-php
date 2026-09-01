<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Channel;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#channel-delete
 */
#[RequiresIntent(Intent::GUILDS)]
class ChannelDelete extends Channel
{
}
