<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Enums;

enum ApplicationIntegrationType: int
{
    case GUILD_INSTALL = 0;
    case USER_INSTALL = 1;
}
