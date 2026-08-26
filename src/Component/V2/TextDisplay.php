<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component\V2;

use CyberWolf\Discord\Component\Component;
use CyberWolf\Discord\Enums\MessageComponentType;

/**
 * Markdown text, the components v2 replacement for a message's content.
 *
 * @see https://discord.com/developers/docs/components/reference#text-display
 */
class TextDisplay extends Component
{
    public function __construct(
        private readonly string $content,
        private readonly ?int $id = null
    ) {
    }

    public function get(): array
    {
        $data = [
            'type' => MessageComponentType::TEXT_DISPLAY->value,
            'content' => $this->content,
        ];

        if (!is_null($this->id)) {
            $data['id'] = $this->id;
        }

        return $data;
    }
}
