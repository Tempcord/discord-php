<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#voice-server-update
 */
class VoiceServerUpdate
{
    public string $token;
    public ?string $guild_id = null;
    public ?string $endpoint = null;
}
