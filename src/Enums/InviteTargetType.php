<?php

declare(strict_types=1);

namespace Tempcord\Discord\Enums;

enum InviteTargetType: int
{
    case STREAM = 1;
    case EMBEDDED_APPLICATION = 2;
}
