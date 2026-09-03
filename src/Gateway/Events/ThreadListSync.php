<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Parts\Channel;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#thread-list-sync
 */
#[RequiresIntent(Intent::GUILDS)]
class ThreadListSync
{
    public string $guild_id;

    /**
     * @var string[]
     */
    public ?array $channel_ids = null;

    /**
     * @var Channel[]
     */
    #[ArrayMapping(Channel::class)]
    public array $threads;

    public array $members;
}
