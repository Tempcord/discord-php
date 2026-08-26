<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component\SelectMenu;

trait HasDefaultValues
{
    protected array $defaultValues = [];

    public function setDefaultValues(array $defaultValues): self
    {
        $this->defaultValues = $defaultValues;

        return $this;
    }
}
