<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel;

use CyberWolf\Discord\Component\Component;
use CyberWolf\Discord\Enums\MessageComponentType;
use CyberWolf\Discord\Exceptions\Rest\Helpers\ComponentBuilder\TooManyRowsException;
use CyberWolf\Discord\Rest\Helpers\GetNew;

/**
 * @see https://discord.com/developers/docs/interactions/message-components#component-object
 */
class ComponentBuilder
{
    use GetNew;

    /**
     * Rows and top level components in the order they were added, since
     * components v2 lets both sit alongside each other.
     *
     * @var array<ComponentRowBuilder|Component>
     */
    private array $components = [];

    public function get(): array
    {
        return array_map(
            static fn (ComponentRowBuilder|Component $component) => $component instanceof ComponentRowBuilder
                ? [
                    'type' => MessageComponentType::ACTION_ROW->value,
                    'components' => $component->get(),
                ]
                : $component->get(),
            $this->components
        );
    }

    /**
     * Can not exceed 5 rows
     *
     * @throws TooManyRowsException
     */
    public function addRow(ComponentRowBuilder $componentRow): self
    {
        if (count($this->getRows()) === 5) {
            throw new TooManyRowsException();
        }

        $this->components[] = $componentRow;

        return $this;
    }

    /**
     * Adds a top level component rather than a row.
     *
     * Everything above type 8 requires the message to carry the
     * IS_COMPONENTS_V2 flag, which also means it can have no content or embeds.
     */
    public function add(Component $component): self
    {
        $this->components[] = $component;

        return $this;
    }

    /**
     * @return ComponentRowBuilder[]
     */
    public function getRows(): array
    {
        return array_values(array_filter(
            $this->components,
            static fn (ComponentRowBuilder|Component $component) => $component instanceof ComponentRowBuilder
        ));
    }

    /**
     * @return array<ComponentRowBuilder|Component>
     */
    public function getComponents(): array
    {
        return $this->components;
    }
}
