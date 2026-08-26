<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Mapping\ArrayMapping;
use CyberWolf\Discord\Parts\Channel;

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
    public ?array $channel_ids;

    /**
     * @var Channel[]
     */
    #[ArrayMapping(Channel::class)]
    public array $threads;

    public array $members;
}
