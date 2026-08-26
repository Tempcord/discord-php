<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Enums;

enum InteractionContextType: int
{
    case GUILD = 0;
    case BOT_DM = 1;
    case PRIVATE_CHANNEL = 2;
}
