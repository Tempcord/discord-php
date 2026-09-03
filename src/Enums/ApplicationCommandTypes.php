<?php

declare(strict_types=1);

namespace Tempcord\Discord\Enums;

enum ApplicationCommandTypes: int
{
    case CHAT_INPUT = 1;
    case USER = 2;
    case MESSAGE = 3;

    /**
     * The one command an app with Activities has in the launcher.
     *
     * Discord creates it itself when Activities are turned on. An app that
     * overwrites its command set has to send it back with the rest or lose it.
     *
     * @see https://discord.com/developers/docs/interactions/application-commands#entry-point-commands
     */
    case PRIMARY_ENTRY_POINT = 4;
}
