<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class EmbedAuthor
{
    public string $name;
    public ?string $url = null;
    public ?string $icon_url = null;
    public ?string $proxy_icon_url = null;
}
