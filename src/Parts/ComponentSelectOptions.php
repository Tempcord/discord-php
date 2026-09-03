<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class ComponentSelectOptions
{
    public string $label;
    public string $value;
    public ?string $description = null;
    public ?Emoji $emoji = null;
    public ?bool $default = null;
}
