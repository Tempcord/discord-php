<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\ApplicationCommandOptionType;
use Tempcord\Discord\Enums\ChannelType;
use Tempcord\Discord\Mapping\ArrayMapping;

class ApplicationCommandOptionStructure
{
    public ApplicationCommandOptionType $type;
    public string $name;
    /**
     * Array of string => string
     * @var string[]
     */
    public ?array $name_localizations = null;
    public string $description;
    /**
     * Array of string => string
     * @var string[]
     */
    public ?array $description_localizations = null;
    public ?bool $required = null;
    /**
     * @var ApplicationCommandOptionChoice[]
     */
    #[ArrayMapping(ApplicationCommandOptionChoice::class)]
    public ?array $choices = null;
    /**
     * @var ApplicationCommandOptionStructure[]
     */
    #[ArrayMapping(ApplicationCommandOptionStructure::class)]
    public ?array $options = null;
    /**
     * @var ChannelType[]
     */
    #[ArrayMapping(ChannelType::class)]
    public ?array $channel_types = null;
    public int|float|null $min_value;
    public int|float|null $max_value;
    public ?int $min_length = null;
    public ?int $max_length = null;
    public ?bool $autocomplete = null;
}
