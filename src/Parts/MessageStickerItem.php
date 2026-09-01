<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\StickerFormatType;

class MessageStickerItem
{
    public string $id;
    public string $name;
    public StickerFormatType $format_type;
}
