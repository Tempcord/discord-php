<?php

declare(strict_types=1);

namespace Tempcord\Discord\Enums;

enum GuildScheduledEventEntityType: int
{
    case STAGE_INSTANCE = 1;
    case VOICE = 2;
    case EXTERNAL = 3;
}
