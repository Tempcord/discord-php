<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Constants\Validation;

use CyberWolf\Discord\Constants\Validation\Traits\WithinLimit;

class ItemLimit
{
    use WithinLimit;

    public const MIN = 1;
    public const MAX = 100;
}
