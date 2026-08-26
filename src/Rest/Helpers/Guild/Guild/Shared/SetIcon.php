<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Guild\Guild\Shared;

use CyberWolf\Discord\Enums\ImageData;
use CyberWolf\Discord\Rest\Helpers\GetBase64Image;

trait SetIcon
{
    use GetBase64Image;

    public function setIcon(string $content, ImageData $imageData): self
    {
        $this->data['icon'] = $this->getBase64Image($content, $imageData);

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->data['icon'] ?? null;
    }
}
