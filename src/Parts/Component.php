<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\ButtonStyle;
use CyberWolf\Discord\Enums\ChannelType;
use CyberWolf\Discord\Enums\MessageComponentType;
use CyberWolf\Discord\Mapping\ArrayMapping;

class Component
{
    public MessageComponentType $type;
    /**
     * @var Component[]
     */
    #[ArrayMapping(Component::class)]
    public ?array $components;
    public ?ButtonStyle $style;
    public ?string $label;
    public ?Emoji $emoji;
    public ?string $custom_id;
    public ?string $url;
    public ?bool $disabled;
    /**
     * @var ComponentSelectOptions[]
     */
    #[ArrayMapping(ComponentSelectOptions::class)]
    public ?array $options; // @todo
    /**
     * @var ChannelType[]
     */
    #[ArrayMapping(ChannelType::class)]
    public ?array $channel_types;
    public ?string $placeholder;
    public ?int $min_values;
    public ?int $max_values;
    public ?bool $required;
    public ?string $value;
}
