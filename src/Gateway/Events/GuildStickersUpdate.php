<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Mapping\ArrayMapping;
use CyberWolf\Discord\Parts\Sticker;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-stickers-update
 */
#[RequiresIntent(Intent::GUILD_EMOJIS_AND_STICKERS)]
class GuildStickersUpdate
{
    public string $guild_id;

    /**
     * @var Sticker[]
     */
    #[ArrayMapping(Sticker::class)]
    public array $stickers;
}
