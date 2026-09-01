<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers;

trait GetNew
{
    public static function new(): static
    {
        return new static();
    }
}
