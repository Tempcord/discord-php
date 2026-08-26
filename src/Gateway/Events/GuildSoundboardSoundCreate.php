<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Parts\SoundboardSound;

/**
 * @see https://discord.com/developers/docs/events/gateway-events#guild-soundboard-sound-create
 */
#[RequiresIntent(Intent::GUILD_EMOJIS_AND_STICKERS)]
class GuildSoundboardSoundCreate extends SoundboardSound
{
}
