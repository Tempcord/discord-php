<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel;

use CyberWolf\Discord\Component\Component;
use CyberWolf\Discord\Exceptions\Rest\Helpers\ComponentRowBuilder\TooManyItemsException;
use CyberWolf\Discord\Rest\Helpers\GetNew;

/**
 * Can not exceed 9 components
 *
 * @see https://discord.com/developers/docs/interactions/message-components#component-object
 */
class ComponentRowBuilder
{
    use GetNew;

    /** @var Component[] */
    private array $components = [];

    public function get(): array
    {
        return array_map(static fn (Component $component) => $component->get(), $this->components);
    }

    /**
     * @throws TooManyItemsException
     */
    public function add(Component $component): self
    {
        if (count($this->components) === 9) {
            throw new TooManyItemsException();
        }

        $this->components[] = $component;

        return $this;
    }
}
