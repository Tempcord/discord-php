<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\ActionType;

class AutoModerationActionStructure
{
    public ActionType $type;
    public ?AutoModerationActionMetadata $metadata;
}
