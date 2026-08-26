<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Enums;

enum ChannelFlag: int
{
    case PINNED = 1 << 1;
    case REQUIRE_TAG = 1 << 4;
}
