<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class ApplicationCommandOptionChoice
{
    public string $name;
    /**
     * Array of string => string
     * @var string[]
     */
    public ?array $name_localizations;
    public string|int|float $value;
}
