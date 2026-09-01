<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\OverwriteType;

class Overwrite
{
    public string $id;
    public OverwriteType $type;
    public string $allow;
    public string $deny;
}
