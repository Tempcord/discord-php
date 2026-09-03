<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\GuildFeature;
use Tempcord\Discord\Mapping\ArrayMapping;

class GuildPreview
{
    public string $id;
    public string $name;
    public ?string $icon = null;
    public ?string $splash = null;
    public ?string $discovery_splash = null;
    public array $emojis;
    /**
     * @var GuildFeature[]
     */
    #[ArrayMapping(GuildFeature::class)]
    public array $features;
    public ?int $approximate_member_count = null;
    public ?int $approximate_presence_count = null;
    public ?string $description = null;
    /**
     * @var Sticker[]
     */
    #[ArrayMapping(Sticker::class)]
    public ?array $stickers = null;
}
