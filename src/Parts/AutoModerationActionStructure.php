<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\ActionType;

class AutoModerationActionStructure
{
    public ActionType $type;
    public ?AutoModerationActionMetadata $metadata;
}
