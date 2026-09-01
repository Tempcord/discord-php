<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Parts\GuildMember;
use Tempcord\Discord\Parts\Presence;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-members-chunk
 */
class GuildMembersChunk
{
    public string $guild_id;

    /**
     * @var GuildMember[]
     */
    #[ArrayMapping(GuildMember::class)]
    public array $members;

    public int $chunk_index;
    public int $chunk_count;
    public array $not_found;

    /**
     * @var Presence[]
     */
    #[ArrayMapping(Presence::class)]
    public array $presences;

    public string $nonce;
}
