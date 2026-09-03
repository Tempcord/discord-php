<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Mapping\ArrayMapping;

class Emoji
{
    public ?string $id = null;
    public ?string $name = null;
    /**
     * @var Role[]
     */
    #[ArrayMapping(Role::class)]
    public ?array $roles = null;
    public ?User $user = null;
    public ?bool $require_colons = null;
    public ?bool $managed = null;
    public ?bool $animated = null;
    public ?bool $available = null;
}
