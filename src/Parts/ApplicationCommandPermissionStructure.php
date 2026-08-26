<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\ApplicationCommandPermissionType;

class ApplicationCommandPermissionStructure
{
    public string $id;
    public ApplicationCommandPermissionType $type;
    public bool $permission;
}
