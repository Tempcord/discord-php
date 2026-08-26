<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component\V2;

use CyberWolf\Discord\Component\Component;
use CyberWolf\Discord\Enums\MessageComponentType;
use CyberWolf\Discord\Enums\SeparatorSpacingSize;

/**
 * Vertical padding between components, optionally drawn as a divider line.
 *
 * @see https://discord.com/developers/docs/components/reference#separator
 */
class Separator extends Component
{
    public function __construct(
        private readonly ?bool $divider = null,
        private readonly ?SeparatorSpacingSize $spacing = null,
        private readonly ?int $id = null
    ) {
    }

    public function get(): array
    {
        $data = ['type' => MessageComponentType::SEPARATOR->value];

        if (!is_null($this->divider)) {
            $data['divider'] = $this->divider;
        }

        if (!is_null($this->spacing)) {
            $data['spacing'] = $this->spacing->value;
        }

        if (!is_null($this->id)) {
            $data['id'] = $this->id;
        }

        return $data;
    }
}
