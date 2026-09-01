<?php

declare(strict_types=1);

namespace Tempcord\Discord\Constants\Validation;

use Tempcord\Discord\Constants\Validation\Traits\WithinLimit;

class ItemLimit
{
    use WithinLimit;

    public const MIN = 1;
    public const MAX = 100;
}
