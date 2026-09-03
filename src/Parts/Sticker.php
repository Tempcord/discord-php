<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\StickerFormatType;
use Tempcord\Discord\Enums\StickerType;

class Sticker
{
    public string $id;
    public ?string $pack_id = null;
    public string $name;
    public ?string $description = null;
    public ?string $tags = null;
    public ?string $asset = null;
    public StickerType $type;
    public StickerFormatType $format_type;
    public bool $available;
    public ?string $guild_id = null;
    public ?User $user = null;
    public ?int $sort_value = null;
}
