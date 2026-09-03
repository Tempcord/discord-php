<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Carbon\Carbon;
use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#channel-pins-update
 */
#[RequiresIntent(Intent::GUILDS)]
class ChannelPinsUpdate
{
    public ?string $guild_id = null;
    public string $channel_id;
    public ?Carbon $last_pin_timestamp = null;
}
