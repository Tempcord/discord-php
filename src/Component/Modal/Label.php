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
        $component = $this->component->get();

        /*
         * Discord rejects the whole modal when the wrapped input carries a
         * label of its own — TEXT_INPUT_COMPONENT_LABEL_IN_LABEL_COMPONENT —
         * and until recently an input could not be built without one. Dropping
         * it here means code written against either shape keeps working, and
         * there is one place the text can come from.
         */
        unset($component['label']);

        $data = [
            'type' => MessageComponentType::LABEL->value,
            'label' => $this->label,
            'component' => $component,
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
