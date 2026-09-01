<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel\Message;

use CyberWolf\Discord\Component\Component;
use CyberWolf\Discord\Rest\Helpers\Channel\ComponentBuilder;
use CyberWolf\Discord\Rest\Helpers\Channel\ComponentRowBuilder;

trait AddComponent
{
    /**
     * Discord fits five buttons across an action row. A row may hold more of
     * other things, which is why ComponentRowBuilder itself allows nine.
     */
    private const int BUTTONS_PER_ROW = 5;

    private ComponentBuilder $components;

    /**
     * @see https://discord.com/developers/docs/interactions/message-components#component-object
     */
    public function setComponents(ComponentBuilder $components): self
    {
        $this->components = $components;

        return $this;
    }

    /**
     * Adds a row holding exactly these components.
     *
     * A select menu has to be alone in its row; buttons may share one.
     */
    public function addRow(Component ...$components): self
    {
        $row = new ComponentRowBuilder();

        foreach ($components as $component) {
            $row->add($component);
        }

        $this->componentBuilder()->addRow($row);

        return $this;
    }

    /**
     * Adds a button, filling the row already being built before starting
     * another.
     *
     * Laying buttons out by hand is the common case and the tedious one, so
     * this does what Discord would make you do anyway: five to a row, then a
     * new row.
     */
    public function addButton(Component $button): self
    {
        $row = $this->openRow();

        if ($row === null) {
            return $this->addRow($button);
        }

        $row->add($button);

        return $this;
    }

    public function getComponents(): ?ComponentBuilder
    {
        return $this->components ?? null;
    }

    public function hasComponents(): bool
    {
        return isset($this->components);
    }

    /**
     * The row a further button would go into, or null when a new one is needed.
     */
    private function openRow(): ?ComponentRowBuilder
    {
        $rows = $this->componentBuilder()->getRows();
        $last = end($rows);

        if ($last === false || $last->count() >= self::BUTTONS_PER_ROW) {
            return null;
        }

        return $last;
    }

    private function componentBuilder(): ComponentBuilder
    {
        return $this->components ??= new ComponentBuilder();
    }
}
