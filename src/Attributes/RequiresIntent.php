<?php

declare(strict_types=1);

namespace Tempcord\Discord\Attributes;

use Attribute;
use Tempcord\Discord\Enums\Intent;

/**
 * Indicates related intents
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class RequiresIntent
{
    public function __construct(public readonly Intent $intent)
    {
    }
}
