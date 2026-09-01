<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\ApplicationCommandPermissionType;

class ApplicationCommandPermissionStructure
{
    public string $id;
    public ApplicationCommandPermissionType $type;
    public bool $permission;
}
