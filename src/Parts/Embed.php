<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;
use Tempcord\Discord\Enums\EmbedType;
use Tempcord\Discord\Mapping\ArrayMapping;

class Embed
{
    public ?string $title = null;
    public ?EmbedType $type = null;
    public ?string $description = null;
    public ?string $url = null;
    public ?Carbon $timestamp = null;
    public ?int $color = null;
    public ?EmbedFooter $footer = null;
    public ?EmbedImage $image = null;
    public ?EmbedThumbnail $thumbnail = null;
    public ?EmbedVideo $video = null;
    public ?EmbedProvider $provider = null;
    public ?EmbedAuthor $author = null;
    /**
     * @var EmbedField[]
     */
    #[ArrayMapping(EmbedField::class)]
    public ?array $fields = null;
}
