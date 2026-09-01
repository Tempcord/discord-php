<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\ApplicationCommandOptionType;
use Tempcord\Discord\Mapping\ArrayMapping;

class ApplicationCommandInteractionDataOptionStructure
{
    public string $name;
    public ApplicationCommandOptionType $type;
    public string|int|float|bool|null $value;
    /**
     * @var ApplicationCommandInteractionDataOptionStructure[]
     */
    #[ArrayMapping(ApplicationCommandInteractionDataOptionStructure::class)]
    public ?array $options;
    public bool $focused;
}
