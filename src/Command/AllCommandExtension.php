<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Command;

use CyberWolf\Discord\Gateway\Events\InteractionCreate;

/**
 * Emits an event for Guild Commands and Global Commands
 */
class AllCommandExtension extends CommandExtension
{
    protected function emitInteraction(InteractionCreate $interaction): bool
    {
        return true;
    }
}
