<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component\Button;

use CyberWolf\Discord\Component\Component;
use CyberWolf\Discord\Enums\ButtonStyle;
use CyberWolf\Discord\Rest\Helpers\Emoji\EmojiBuilder;

abstract class InteractionButton extends Component
{
    protected ButtonStyle $style;

    public function __construct(
        public readonly string $customId,
        protected ?string $label = null,
        protected ?EmojiBuilder $emoji = null,
        protected bool $disabled = false
    ) {
    }

    public function get(): array
    {
        $data =  [
            'type' => 2,
            'style' => $this->style->value,
            'custom_id' => $this->customId,
            'disabled' => $this->disabled,
        ];

        if (!is_null($this->label)) {
            $data['label'] = $this->label;
        }

        if (!is_null($this->emoji)) {
            $data['emoji'] = $this->emoji->get();
        }

        return $data;
    }
}
