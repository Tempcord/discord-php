<?php

declare(strict_types=1);

namespace Tempcord\Discord\Enums;

/**
 * What happens when somebody uses an entry point command.
 *
 * @see https://discord.com/developers/docs/interactions/application-commands#entry-point-commands
 */
enum EntryPointCommandHandlerType: int
{
    /**
     * The app is sent the interaction and answers it, which is the way to
     * decide anything before the activity opens.
     */
    case APP_HANDLER = 1;

    /**
     * Discord opens the activity itself and the app hears nothing.
     */
    case DISCORD_LAUNCH_ACTIVITY = 2;
}
