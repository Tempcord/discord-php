<?php

declare(strict_types=1);

namespace Tempcord\Discord\Command;

use Tempcord\Discord\Gateway\Events\InteractionCreate;

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
