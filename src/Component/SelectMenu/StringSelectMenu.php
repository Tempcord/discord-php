<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component\SelectMenu;

use CyberWolf\Discord\Enums\SelectMenuType;
use CyberWolf\Discord\Exceptions\Components\SelectMenu\StringSelectMenu\NoOptionsException;
use CyberWolf\Discord\Exceptions\Components\SelectMenu\StringSelectMenu\TooManyOptionsException;
use CyberWolf\Discord\Rest\Helpers\Emoji\EmojiBuilder;

class StringSelectMenu extends SelectMenu
{
    protected SelectMenuType $type = SelectMenuType::String;

    protected array $items = [];

    /**
     * Can not exceed 25 options
     *
     * @throws TooManyOptionsException
     */
    public function addOption(
        string $label,
        string $value,
        ?string $description = null,
        ?EmojiBuilder $emoji = null,
        ?bool $default = null
    ): self {
        if (count($this->items) === 25) {
            throw new TooManyOptionsException();
        }

        $item = [
            'label' => $label,
            'value' => $value,
        ];

        if (!is_null($description)) {
            $item['description'] = $description;
        }

        if (!is_null($emoji)) {
            $item['emoji'] = $emoji->get();
        }

        if (!is_null($default)) {
            $item['default'] = $default;
        }

        $this->items[] = $item;

        return $this;
    }

    /**
     * @throws NoOptionsException
     */
    public function get(): array
    {
        if (count($this->items) === 0) {
            throw new NoOptionsException();
        }

        return [
            ...parent::get(),
            'options' => $this->items
        ];
    }
}
