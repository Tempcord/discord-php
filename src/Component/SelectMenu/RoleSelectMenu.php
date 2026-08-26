<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component\SelectMenu;

use CyberWolf\Discord\Enums\SelectMenuType;

class RoleSelectMenu extends SelectMenu
{
    use HasDefaultValues;

    protected SelectMenuType $type = SelectMenuType::Role;

    public function get(): array
    {
        return [
            ...parent::get(),
            'default_values' => $this->defaultValues,
        ];
    }
}
