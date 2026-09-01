<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Parts\Sticker;

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
