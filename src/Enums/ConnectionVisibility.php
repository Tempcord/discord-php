<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Enums;

enum ConnectionVisibility: int
{
    case None = 0;
    case Everyone = 1;
}
