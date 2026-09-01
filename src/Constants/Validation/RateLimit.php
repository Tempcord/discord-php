<?php

declare(strict_types=1);

namespace Tempcord\Discord\Constants\Validation;

use Tempcord\Discord\Constants\Validation\Traits\WithinLimit;

class RateLimit
{
    use WithinLimit;

    public const MIN = 0;
    public const MAX = 21600;
}
