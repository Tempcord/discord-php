<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\ButtonStyle;
use Tempcord\Discord\Enums\ChannelType;
use Tempcord\Discord\Enums\MessageComponentType;
use Tempcord\Discord\Mapping\ArrayMapping;

class Component
{
    public MessageComponentType $type;
    /**
     * @var Component[]
     */
    #[ArrayMapping(Component::class)]
    public ?array $components = null;
    public ?ButtonStyle $style = null;
    public ?string $label = null;
    public ?Emoji $emoji = null;
    public ?string $custom_id = null;
    public ?string $url = null;
    public ?bool $disabled = null;
    /**
     * @var ComponentSelectOptions[]
     */
    #[ArrayMapping(ComponentSelectOptions::class)]
    public ?array $options; // @todo
    /**
     * @var ChannelType[]
     */
    #[ArrayMapping(ChannelType::class)]
    public ?array $channel_types = null;
    public ?string $placeholder = null;
    public ?int $min_values = null;
    public ?int $max_values = null;
    public ?bool $required = null;
    public ?string $value = null;
}
