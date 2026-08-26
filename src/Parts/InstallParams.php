<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\Scope;
use CyberWolf\Discord\Mapping\ArrayMapping;

class InstallParams
{
    /**
     * @var Scope[]
     */
    #[ArrayMapping(Scope::class)]
    public array $scopes;
    public string $permissions;
}
