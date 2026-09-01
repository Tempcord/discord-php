<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Parts\SoundboardSound;

/**
 * Sent in response to a request for a guild's soundboard sounds over the
 * gateway, rather than under an intent.
 *
 * @see https://discord.com/developers/docs/events/gateway-events#soundboard-sounds
 */
class SoundboardSounds
{
    /**
     * @var SoundboardSound[]
     */
    #[ArrayMapping(SoundboardSound::class)]
    public array $soundboard_sounds;
    public string $guild_id;
}
