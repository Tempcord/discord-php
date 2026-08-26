<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Webhook\Shared;

use CyberWolf\Discord\Enums\ImageData;
use CyberWolf\Discord\Rest\Helpers\GetBase64Image;

trait SetAvatar
{
    use GetBase64Image;

    public function setAvatar(string $content, ImageData $imageData): static
    {
        $this->data['avatar'] = $this->getBase64Image($content, $imageData);

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->data['avatar'] ?? null;
    }
}
