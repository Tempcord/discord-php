<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Enums;

enum MessageNotificationLevel: int
{
    case ALL_MESSAGES = 0;
    case ONLY_MENTIONS = 1;
}
