<?php

declare(strict_types=1);

namespace Tempcord\Discord\Enums;

enum OverwriteType: int
{
    case ROLE = 0;
    case MEMBER = 1;
}
