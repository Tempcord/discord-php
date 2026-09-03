<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class EmbedThumbnail
{
    public string $url;
    public ?string $proxy_url = null;
    public ?int $height = null;
    public ?int $width = null;
}
