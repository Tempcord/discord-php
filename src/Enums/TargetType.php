<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Enums;

enum TargetType: int
{
    case STREAM = 1;
    case EMBEDDED_APPLICATION = 2;
}
