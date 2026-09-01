<?php

declare(strict_types=1);

namespace Tempcord\Discord\Command;

use Evenement\EventEmitter;
use Tempcord\Discord\Constants\Events;
use Tempcord\Discord\Discord;
use Tempcord\Discord\Enums\ApplicationCommandOptionType;
use Tempcord\Discord\Enums\InteractionType;
use Tempcord\Discord\Extension\Extension;
use Tempcord\Discord\FilteredEventEmitter;
use Tempcord\Discord\Gateway\Events\InteractionCreate;
use Tempcord\Discord\Interaction\CommandInteraction;
use Tempcord\Discord\Parts\ApplicationCommandInteractionDataOptionStructure;

abstract class CommandExtension extends EventEmitter implements Extension
{
    protected FilteredEventEmitter $commandListener;

    abstract protected function emitInteraction(InteractionCreate $interaction): bool;

    public function initialize(Discord $discord): void
    {
        $this->commandListener = new FilteredEventEmitter(
            $discord->gateway->events,
            Events::INTERACTION_CREATE,
            fn (InteractionCreate $interactionCreate) =>
                isset($interactionCreate->type)
                && $interactionCreate->type === InteractionType::APPLICATION_COMMAND
                && $this->emitInteraction($interactionCreate)
        );

        $this->commandListener->on(Events::INTERACTION_CREATE, function (InteractionCreate $interaction) use ($discord) {
            $this->handleInteraction($interaction, $discord);
        });

        $this->commandListener->start();
    }

    private function handleInteraction(InteractionCreate $interaction, Discord $discord)
    {
        $commandName = $this->getFullNameByInteraction($interaction);
        $firedCommand = new CommandInteraction($interaction, $discord);

        $this->emit($commandName, [$firedCommand]);
    }

    protected function getFullNameByInteraction(InteractionCreate $command): string
    {
        $names = [$command->data->name];

        $this->drillName($command->data->options ?? [], $names);

        return implode('.', $names);
    }

    private function drillName(array $options, array &$names)
    {
        /** @var ?ApplicationCommandInteractionDataOptionStructure */
        $subCommand = array_find($options ?? [], function (ApplicationCommandInteractionDataOptionStructure $option) {
            return in_array(
                $option->type,
                [
                    ApplicationCommandOptionType::SUB_COMMAND,
                    ApplicationCommandOptionType::SUB_COMMAND_GROUP,
                ]
            );
        });

        if (!is_null($subCommand)) {
            $names[] = $subCommand->name;

            $this->drillName($subCommand->options ?? [], $names);
        }
    }
}
