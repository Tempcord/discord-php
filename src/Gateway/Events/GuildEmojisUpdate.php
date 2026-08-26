<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Mapping\ArrayMapping;
use CyberWolf\Discord\Parts\Emoji;

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
