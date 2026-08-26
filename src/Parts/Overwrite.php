<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\OverwriteType;

class Overwrite
{
    public string $id;
    public OverwriteType $type;
    public string $allow;
    public string $deny;
}
