<?php

declare(strict_types=1);

namespace Tempcord\Discord\Interaction;

use Tempcord\Discord\Discord;
use Tempcord\Discord\Enums\MessageComponentType;
use Tempcord\Discord\Gateway\Events\InteractionCreate;
use Tempcord\Discord\Interaction\Concerns\OpensModal;
use Tempcord\Discord\Interaction\Concerns\RespondsToInteraction;
use Tempcord\Discord\Interaction\Concerns\UpdatesMessage;

/**
 * A message component a user interacted with: a button press or a select menu
 * choice.
 *
 * @see https://discord.com/developers/docs/interactions/receiving-and-responding#message-component-data-structure
 */
class ComponentInteraction
{
    use RespondsToInteraction;
    use UpdatesMessage;
    use OpensModal;

    public function __construct(public readonly InteractionCreate $interaction, private Discord $discord)
    {
    }

    /**
     * The custom id of the component that was interacted with.
     */
    public function getCustomId(): ?string
    {
        return $this->interaction->data->custom_id ?? null;
    }

    public function getComponentType(): ?MessageComponentType
    {
        return $this->interaction->data->component_type ?? null;
    }

    /**
     * Everything the user picked in a select menu. Values are the option values
     * for a string select, and ids for the user, role, mentionable and channel
     * selects.
     *
     * Empty for anything that is not a select menu, and for a select menu the
     * user cleared.
     *
     * @return string[]
     */
    public function getValues(): array
    {
        return $this->interaction->data->values ?? [];
    }

    /**
     * The first selected value, for the common case of a select menu that only
     * allows one choice.
     */
    public function getValue(): ?string
    {
        return $this->getValues()[0] ?? null;
    }
}
