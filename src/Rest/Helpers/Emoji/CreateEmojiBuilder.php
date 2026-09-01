<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers\Emoji;

use Tempcord\Discord\Enums\ImageData;
use Tempcord\Discord\Rest\Helpers\GetBase64Image;
use Tempcord\Discord\Rest\Helpers\GetNew;

class CreateEmojiBuilder
{
    use GetNew;
    use GetBase64Image;

    private array $data = [];

    public function setName(string $name): self
    {
        $this->data['name'] = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    public function setRoles(array $roles): self
    {
        $this->data['roles'] = $roles;

        return $this;
    }

    /** @return ?string[] */
    public function getRoles(): ?array
    {
        return $this->data['roles'] ?? null;
    }

    public function setImage(string $content, ImageData $imageData): self
    {
        $this->data['image'] = $this->getBase64Image($content, $imageData);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->data['image'] ?? null;
    }

    public function get(): array
    {
        return $this->data;
    }
}
