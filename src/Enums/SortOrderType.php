<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Enums;

enum SortOrderType: int
{
    case LATEST_ACTIVITY = 0;
    case CREATION_DATE = 1;
}
