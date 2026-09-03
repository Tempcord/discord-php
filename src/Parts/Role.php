<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class Role
{
    public string $id;
    public string $name;
    public int $color;
    public bool $hoist;
    public ?string $icon = null;
    public ?string $unicode_emoji = null;
    public int $position;
    public string $permissions;
    public bool $managed;
    public bool $mentionable;
    public ?RoleTags $tags = null;
    public int $flags;
}
