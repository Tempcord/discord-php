<?php

declare(strict_types=1);

namespace Tempcord\Discord\Constants\Validation\Traits;

trait WithinLimit
{
    public static function withinLimit(int $input): int
    {
        return min(max($input, static::MIN), static::MAX);
    }
}
