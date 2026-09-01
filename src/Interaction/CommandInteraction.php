<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Interaction;

use CyberWolf\Discord\Discord;
use CyberWolf\Discord\Enums\ApplicationCommandOptionType as OptionTypes;
use CyberWolf\Discord\Gateway\Events\InteractionCreate;
use CyberWolf\Discord\Interaction\Concerns\OpensModal;
use CyberWolf\Discord\Interaction\Concerns\RespondsToInteraction;
use CyberWolf\Discord\Parts\ApplicationCommandInteractionDataOptionStructure as OptionStructure;

class CommandInteraction
{
    use RespondsToInteraction;
    use OpensModal;

    /** @var OptionStructure[] */
    private array $options = [];

    public function __construct(public readonly InteractionCreate $interaction, private Discord $discord)
    {
        /** @var OptionStructure[] */
        $options = $this->interaction->data->options ?? [];
        foreach ($options as $option) {
            $this->options[$option->name] = $option;
        }
    }

    public function getOption(string $path): ?OptionStructure
    {
        $segments = explode('.', $path);
        return $this->findOption($this->options, $segments);
    }

    private function findOption(array $options, array $segments): ?OptionStructure
    {
        $currentSegment = array_shift($segments);

        $option = array_find($options, fn (OptionStructure $option) => $option->name === $currentSegment);

        if (empty($segments)) {
            return $option;
        }

        return empty($option->options) ? null : $this->findOption($option->options, $segments);
    }

    public function hasOption(string $path): bool
    {
        $segments = explode('.', $path);
        return $this->findOption($this->options, $segments) !== null;
    }

    public function getSubCommandName(): ?string
    {
        return $this->getSubCommandNameFromOptions(
            $this->options
        );
    }

    /**
     * @param OptionStructure[] $options
     */
    private function getSubCommandNameFromOptions(array $options): ?string
    {
        $subItem = array_values(array_filter(
            $options,
            static fn (OptionStructure $option) => in_array(
                $option->type,
                [OptionTypes::SUB_COMMAND, OptionTypes::SUB_COMMAND_GROUP]
            )
        ))[0] ?? null;

        if (is_null($subItem)) {
            return null;
        }

        return $subItem->type === OptionTypes::SUB_COMMAND
            ? $subItem->name
            : $subItem->name . ':' . $this->getSubCommandNameFromOptions($subItem->options);
    }
}
