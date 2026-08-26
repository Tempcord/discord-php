<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Command;

use CyberWolf\Discord\Gateway\Events\InteractionCreate;

/**
 * Emits an event for each Global Command used anywhere
 */
class GlobalCommandExtension extends CommandExtension
{
    protected function emitInteraction(InteractionCreate $interaction): bool
    {
        return !isset($interaction->data->guild_id);
    }
}
