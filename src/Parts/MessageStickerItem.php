<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\StickerFormatType;

class MessageStickerItem
{
    public string $id;
    public string $name;
    public StickerFormatType $format_type;
}
