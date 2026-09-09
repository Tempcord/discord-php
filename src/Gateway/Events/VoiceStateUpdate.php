<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\VoiceState;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#voice-state-update
 */
#[RequiresIntent(Intent::GUILD_VOICE_STATES)]
class VoiceStateUpdate extends VoiceState
{
    /**
     * The state that preceded this event, supplied by Tempcord's cache
     * subscriber. The event object itself remains the new state, matching the
     * Discord gateway payload. Null means Discord had not previously reported
     * this member's voice state during the current connection.
     */
    public ?VoiceState $oldState = null;
}
