<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Command;

use Fakes\Tempcord\Discord\DiscordFake;
use PHPUnit\Framework\TestCase;
use Tempcord\Discord\Command\AllCommandExtension;
use Tempcord\Discord\Constants\Events;
use Tempcord\Discord\Discord;
use Tempcord\Discord\Enums\ApplicationCommandOptionType;
use Tempcord\Discord\Enums\InteractionType;
use Tempcord\Discord\Gateway\Events\InteractionCreate;
use Tempcord\Discord\Interaction\CommandInteraction;
use Tempcord\Discord\Parts\ApplicationCommandInteractionDataOptionStructure;
use Tempcord\Discord\Parts\InteractionData;

class AllCommandExtensionTest extends TestCase
{
    private Discord $discord;

    protected function setUp(): void
    {
        $this->discord = DiscordFake::get();
    }

    public function testItEmitsEventsForApplicationCommands()
    {
        $extension = new AllCommandExtension();
        $extension->initialize($this->discord);

        $hasRun = [false, false, false];

        $extension->on('command-1', function (CommandInteraction $firedCommand) use (&$hasRun) {
            $hasRun[0] = true;
        });

        $extension->on('command-2', function (CommandInteraction $firedCommand) use (&$hasRun) {
            $hasRun[1] = true;
        });

        $extension->on('command-3', function (CommandInteraction $firedCommand) use (&$hasRun) {
            $hasRun[2] = true;
        });

        $interaction = new InteractionCreate();
        $interaction->type = InteractionType::APPLICATION_COMMAND;
        $interaction->data = new InteractionData();
        $interaction->data->name = 'command-1';

        $this->discord->gateway->events->emit(
            Events::INTERACTION_CREATE,
            [$interaction]
        );

        $interaction->data->name = 'command-2';
        $interaction->data->guild_id = '::guild id::';

        $this->discord->gateway->events->emit(
            Events::INTERACTION_CREATE,
            [$interaction]
        );

        $this->assertTrue($hasRun[0], 'Command 1 did not run');
        $this->assertTrue($hasRun[1], 'Command 2 did not run');
        $this->assertFalse($hasRun[2], 'Command 3 should not have been run');
    }

    public function testItEmitsEventsForGuildCommands()
    {
        $extension = new AllCommandExtension();
        $extension->initialize($this->discord);

        $hasRun = [false, false, false];

        $extension->on('command-1', function (CommandInteraction $firedCommand) use (&$hasRun) {
            $hasRun[0] = true;
        });

        $extension->on('command-2', function (CommandInteraction $firedCommand) use (&$hasRun) {
            $hasRun[1] = true;
        });

        $extension->on('command-3', function (CommandInteraction $firedCommand) use (&$hasRun) {
            $hasRun[2] = true;
        });

        $interaction = new InteractionCreate();
        $interaction->type = InteractionType::APPLICATION_COMMAND;
        $interaction->data = new InteractionData();
        $interaction->data->name = 'command-1';

        $this->discord->gateway->events->emit(
            Events::INTERACTION_CREATE,
            [$interaction]
        );

        $interaction->data->name = 'command-2';

        $this->discord->gateway->events->emit(
            Events::INTERACTION_CREATE,
            [$interaction]
        );

        $this->assertTrue($hasRun[0], 'Command 1 did not run');
        $this->assertTrue($hasRun[1], 'Command 2 did not run');
        $this->assertFalse($hasRun[2], 'Command 3 should not have been run');
    }

    public static function nameMappingProvider(): array
    {
        return [
            'Plain name' => [
                'interaction' => (function () {
                    $command = new InteractionCreate();
                    $command->type = InteractionType::APPLICATION_COMMAND;
                    $command->data = new InteractionData();
                    $command->data->name = 'command-name';

                    return $command;
                })(),
                'expectedName' => 'command-name'
            ],

            'Nested 1 layer' => [
                'interaction' => (function () {
                    $command = new InteractionCreate();
                    $command->type = InteractionType::APPLICATION_COMMAND;
                    $command->data = new InteractionData();
                    $command->data->name = 'command-name';

                    $command->data->options = [new ApplicationCommandInteractionDataOptionStructure()];
                    $command->data->options[0]->name = 'sub';
                    $command->data->options[0]->type = ApplicationCommandOptionType::SUB_COMMAND;

                    return $command;
                })(),
                'expectedName' => 'command-name.sub'
            ],

            'Nested 2 layer' => [
                'interaction' => (function () {
                    $command = new InteractionCreate();
                    $command->type = InteractionType::APPLICATION_COMMAND;
                    $command->data = new InteractionData();
                    $command->data->name = 'command-name';

                    $command->data->options = [new ApplicationCommandInteractionDataOptionStructure()];
                    $command->data->options[0]->name = 'double';
                    $command->data->options[0]->type = ApplicationCommandOptionType::SUB_COMMAND_GROUP;

                    $command->data->options[0]->options = [new ApplicationCommandInteractionDataOptionStructure()];
                    $command->data->options[0]->options[0]->name = 'sub';
                    $command->data->options[0]->options[0]->type = ApplicationCommandOptionType::SUB_COMMAND_GROUP;

                    return $command;
                })(),
                'expectedName' => 'command-name.double.sub'
            ],

            'Nested 3 layer' => [ // NOTE: Not supported by Discord
                'interaction' => (function () {
                    $command = new InteractionCreate();
                    $command->type = InteractionType::APPLICATION_COMMAND;
                    $command->data = new InteractionData();
                    $command->data->name = 'command-name';

                    $command->data->options = [new ApplicationCommandInteractionDataOptionStructure()];
                    $command->data->options[0]->name = 'double';
                    $command->data->options[0]->type = ApplicationCommandOptionType::SUB_COMMAND_GROUP;

                    $command->data->options[0]->options = [new ApplicationCommandInteractionDataOptionStructure()];
                    $command->data->options[0]->options[0]->name = 'sub';
                    $command->data->options[0]->options[0]->type = ApplicationCommandOptionType::SUB_COMMAND_GROUP;

                    $command->data->options[0]->options[0]->options = [new ApplicationCommandInteractionDataOptionStructure()];
                    $command->data->options[0]->options[0]->options[0]->name = 'dub';
                    $command->data->options[0]->options[0]->options[0]->type = ApplicationCommandOptionType::SUB_COMMAND_GROUP;

                    return $command;
                })(),
                'expectedName' => 'command-name.double.sub.dub'
            ],
        ];
    }
}
