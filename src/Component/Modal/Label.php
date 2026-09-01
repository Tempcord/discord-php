<?php

declare(strict_types=1);

namespace Tempcord\Discord\Component\Modal;

use Tempcord\Discord\Component\Component;
use Tempcord\Discord\Enums\MessageComponentType;

/**
 * Wraps a single input with the text shown above it. Every interactive
 * component in a modal sits inside one of these.
 *
 * @see https://discord.com/developers/docs/components/reference#label
 */
class Label extends Component
{
    public function __construct(
        private readonly string $label,
        private readonly Component $component,
        private readonly ?string $description = null,
        private readonly ?int $id = null
    ) {
    }

    public function get(): array
    {
        $data = [
            'type' => MessageComponentType::LABEL->value,
            'label' => $this->label,
            'component' => $this->component->get(),
        ];

        if (!is_null($this->description)) {
            $data['description'] = $this->description;
        }

        if (!is_null($this->id)) {
            $data['id'] = $this->id;
        }

        return $data;
    }
}
