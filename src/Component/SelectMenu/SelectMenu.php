<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component\SelectMenu;

use CyberWolf\Discord\Component\Component;
use CyberWolf\Discord\Enums\SelectMenuType;

abstract class SelectMenu extends Component
{
    protected SelectMenuType $type;

    public function __construct(
        protected string $customId,
        protected ?string $placeholder = null,
        protected ?int $minValues = null,
        protected ?int $maxValues = null,
        protected bool $disabled = false
    ) {
    }

    public function get(): array
    {
        $data = [
            'type' => $this->type,
            'custom_id' => $this->customId,
            'min_values' => $this->minValues ?? 1,
            'max_values' => $this->maxValues ?? 25,
            'disabled' => $this->disabled
        ];

        if (!is_null($this->placeholder)) {
            $data['placeholder'] = $this->placeholder;
        }

        return $data;
    }
}
