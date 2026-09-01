<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\Scope;
use Tempcord\Discord\Mapping\ArrayMapping;

class InstallParams
{
    /**
     * @var Scope[]
     */
    #[ArrayMapping(Scope::class)]
    public array $scopes;
    public string $permissions;
}
