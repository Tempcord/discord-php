<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class Attachment
{
    public string $id;
    public string $filename;
    public ?string $description = null;
    public ?string $content_type = null;
    public int $size;
    public string $url;
    public string $proxy_url;
    public ?int $height = null;
    public ?int $width = null;
    public ?bool $ephemeral = null;
}
