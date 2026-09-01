<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Parts\Emoji;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-emojis-update
 */
#[RequiresIntent(Intent::GUILD_EMOJIS_AND_STICKERS)]
class GuildEmojisUpdate
{
    public string $guild_id;

    /**
     * @var Emoji[]
     */
    #[ArrayMapping(Emoji::class)]
    public array $emojis;
}
