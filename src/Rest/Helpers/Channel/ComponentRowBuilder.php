<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers\Channel;

use Tempcord\Discord\Component\Component;
use Tempcord\Discord\Exceptions\Rest\Helpers\ComponentRowBuilder\TooManyItemsException;
use Tempcord\Discord\Rest\Helpers\GetNew;

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

    /**
     * What the row holds, unserialised.
     *
     * get() cannot answer this: it renders every component, and a select menu
     * with no options yet throws rather than returning.
     *
     * @return Component[]
     */
    public function getComponents(): array
    {
        return $this->components;
    }

    public function count(): int
    {
        return count($this->components);
    }
}
