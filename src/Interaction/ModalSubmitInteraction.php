<?php

declare(strict_types=1);

namespace Tempcord\Discord\Interaction;

use Tempcord\Discord\Discord;
use Tempcord\Discord\Gateway\Events\InteractionCreate;
use Tempcord\Discord\Interaction\Concerns\RespondsToInteraction;
use Tempcord\Discord\Interaction\Concerns\UpdatesMessage;

/**
 * A submitted modal, and the fields the user filled in.
 *
 * @see https://discord.com/developers/docs/interactions/receiving-and-responding#modal-submit-data-structure
 */
class ModalSubmitInteraction
{
    use RespondsToInteraction;
    use UpdatesMessage;

    public function __construct(public readonly InteractionCreate $interaction, private Discord $discord)
    {
    }

    /**
     * The custom id of the modal itself, not of any field within it.
     */
    public function getCustomId(): ?string
    {
        return $this->interaction->data->custom_id ?? null;
    }

    /**
     * What the user typed into the field with the given custom id.
     */
    public function getValue(string $customId): ?string
    {
        return $this->getValues()[$customId] ?? null;
    }

    public function hasValue(string $customId): bool
    {
        return array_key_exists($customId, $this->getValues());
    }

    /**
     * Every submitted field, keyed by its custom id.
     *
     * Discord nests these differently depending on how the modal was built —
     * inside action rows classically, inside labels for the newer components —
     * so the payload is walked rather than assumed to be a fixed depth.
     *
     * @return array<string, string>
     */
    public function getValues(): array
    {
        $values = [];

        $this->collect($this->interaction->data->components ?? [], $values);

        return $values;
    }

    /**
     * @param array<string, string> $values
     */
    private function collect(array $components, array &$values): void
    {
        foreach ($components as $component) {
            $component = (array) $component;

            if (isset($component['custom_id'], $component['value'])) {
                $values[$component['custom_id']] = $component['value'];
            }

            if (!empty($component['components'])) {
                $this->collect((array) $component['components'], $values);
            }

            if (!empty($component['component'])) {
                $this->collect([$component['component']], $values);
            }
        }
    }
}
