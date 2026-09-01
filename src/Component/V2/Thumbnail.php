<?php

declare(strict_types=1);

namespace Tempcord\Discord\Component\V2;

use Tempcord\Discord\Component\Component;
use Tempcord\Discord\Enums\MessageComponentType;

/**
 * A small image, only valid as the accessory of a section.
 *
 * @see https://discord.com/developers/docs/components/reference#thumbnail
 */
class Thumbnail extends Component
{
    public function __construct(
        private readonly UnfurledMedia $media,
        private readonly ?string $description = null,
        private readonly ?bool $spoiler = null,
        private readonly ?int $id = null
    ) {
    }

    public function get(): array
    {
        $data = [
            'type' => MessageComponentType::THUMBNAIL->value,
            'media' => $this->media->get(),
        ];

        if (!is_null($this->description)) {
            $data['description'] = $this->description;
        }

        if (!is_null($this->spoiler)) {
            $data['spoiler'] = $this->spoiler;
        }

        if (!is_null($this->id)) {
            $data['id'] = $this->id;
        }

        return $data;
    }
}
