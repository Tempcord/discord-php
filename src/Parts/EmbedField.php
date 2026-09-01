<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class EmbedField
{
    public string $name;
    public string $value;
    public ?bool $inline;
}
