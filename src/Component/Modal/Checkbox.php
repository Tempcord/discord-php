<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component\Modal;

use CyberWolf\Discord\Component\Component;
use CyberWolf\Discord\Enums\MessageComponentType;

/**
 * A single on or off checkbox.
 *
 * @see https://discord.com/developers/docs/components/reference#checkbox
 */
class Checkbox extends Component
{
    public function __construct(
        private readonly string $customId,
        private readonly ?bool $default = null,
        private readonly ?int $id = null
    ) {
    }

    public function get(): array
    {
        $data = [
            'type' => MessageComponentType::CHECKBOX->value,
            'custom_id' => $this->customId,
        ];

        if (!is_null($this->default)) {
            $data['default'] = $this->default;
        }

        if (!is_null($this->id)) {
            $data['id'] = $this->id;
        }

        return $data;
    }
}
