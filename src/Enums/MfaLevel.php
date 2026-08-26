<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Enums;

enum MfaLevel: int
{
    case NONE = 0;
    case ELEVATED = 1;
}
