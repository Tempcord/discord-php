<?php

declare(strict_types=1);

namespace Tempcord\Discord\Component\SelectMenu;

use Tempcord\Discord\Enums\SelectMenuType;

class UserSelectMenu extends SelectMenu
{
    use HasDefaultValues;

    protected SelectMenuType $type = SelectMenuType::User;

    public function get(): array
    {
        return [
            ...parent::get(),
            'default_values' => $this->defaultValues,
        ];
    }
}
