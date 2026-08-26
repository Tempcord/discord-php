<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Webhook\Shared;

trait SetName
{
    public function setName(string $name): static
    {
        $this->data['name'] = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }
}
