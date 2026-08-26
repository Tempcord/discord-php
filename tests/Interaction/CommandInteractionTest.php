<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Interaction;

use Fakes\CyberWolf\Discord\DataMapperFake;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use CyberWolf\Discord\Interaction\CommandInteraction;
use CyberWolf\Discord\Interaction\Helpers\InteractionCallbackBuilder;
use CyberWolf\Discord\Parts\ApplicationCommandInteractionDataOptionStructure;
use CyberWolf\Discord\Parts\InteractionData;
use CyberWolf\Discord\Rest\Helpers\Webhook\EditWebhookBuilder;
use CyberWolf\Discord\Gateway\Events\InteractionCreate;
use Fakes\CyberWolf\Discord\DiscordFake;
use Fakes\CyberWolf\Discord\PromiseFake;

class CommandInteractionTest extends MockeryTestCase
{
    private function getInteractionCreate(): InteractionCreate
    {
        $interactionCreate = new InteractionCreate();
        $interactionCreate->id = '::interaction id::';
        $interactionCreate->token = '::interaction token::';
        $interactionCreate->application_id = '::application id::';

        return $interactionCreate;
    }

    public function testCreateInteractionResponse(): void
    {
        $discord = DiscordFake::get();
        $interactionCallbackBuilder = Mockery::mock(InteractionCallbackBuilder::class);

        $discord->rest->webhook
            ->shouldReceive('createInteractionResponse')
            ->with('::interaction id::', '::interaction token::', $interactionCallbackBuilder)
            ->andReturn(PromiseFake::get('::result::'))
            ->once();

        $commandInteraction = new CommandInteraction($this->getInteractionCreate(), $discord);

        $commandInteraction->createInteractionResponse($interactionCallbackBuilder);
    }

    public function testGetInteractionResponse(): void
    {
        $discord = DiscordFake::get();

        $discord->rest->webhook
            ->shouldReceive('getOriginalInteractionResponse')
            ->with('::application id::', '::interaction token::')
            ->andReturn(PromiseFake::get())
            ->once();

        $commandInteraction = new CommandInteraction($this->getInteractionCreate(), $discord);

        $commandInteraction->getInteractionResponse();
    }

    public function testEditOriginalInteractionResponse(): void
    {
        $discord = DiscordFake::get();
        $editWebhookBuilder = Mockery::mock(EditWebhookBuilder::class);

        $discord->rest->webhook
            ->shouldReceive('editOriginalInteractionResponse')
            ->with('::application id::', '::interaction token::', $editWebhookBuilder)
            ->andReturn(PromiseFake::get('::result::'))
            ->once();

        $commandInteraction = new CommandInteraction($this->getInteractionCreate(), $discord);

        $commandInteraction->editInteractionResponse($editWebhookBuilder);
    }

    public function testDeleteInteractionResponse(): void
    {
        $discord = DiscordFake::get();

        $discord->rest->webhook
            ->shouldReceive('deleteOriginalInteractionResponse')
            ->with('::application id::', '::interaction token::')
            ->once();

        $commandInteraction = new CommandInteraction($this->getInteractionCreate(), $discord);

        $commandInteraction->deleteInteractionResponse();
    }

    public function testParsesOptions(): void
    {
        $interactionCreate = $this->getInteractionCreate();

        $interactionCreate->data = new InteractionData();
        $interactionCreate->data->options = [
            new ApplicationCommandInteractionDataOptionStructure()
        ];

        $interactionCreate->data->options[0]->name = 'funny_name';
        $interactionCreate->data->options[0]->value = '::value::';

        $commandInteraction = new CommandInteraction($interactionCreate, DiscordFake::get());

        $this->assertTrue($commandInteraction->hasOption('funny_name'));
        $this->assertFalse($commandInteraction->hasOption('other_name'));

        $this->assertNull($commandInteraction->getOption('other_name'));
        $this->assertEquals($interactionCreate->data->options[0], $commandInteraction->getOption('funny_name'));

        $interactionCreate = $this->getInteractionCreate();

        $interactionCreate->data = new InteractionData();
        $interactionCreate->data->options = [
            new ApplicationCommandInteractionDataOptionStructure()
        ];

        $interactionCreate->data->options[0]->name = 'foo';
        $interactionCreate->data->options[0]->type = \CyberWolf\Discord\Enums\ApplicationCommandOptionType::SUB_COMMAND;
        $interactionCreate->data->options[0]->options = [
            new ApplicationCommandInteractionDataOptionStructure()
        ];
        $interactionCreate->data->options[0]->options[0]->name = 'bar';
        $interactionCreate->data->options[0]->options[0]->value = '::value::';

        $commandInteraction = new CommandInteraction($interactionCreate, DiscordFake::get());

        $this->assertTrue($commandInteraction->hasOption('foo.bar'));
        $this->assertFalse($commandInteraction->hasOption('foo.baz'));

        $this->assertNull($commandInteraction->getOption('foo.baz'));
        $this->assertEquals($interactionCreate->data->options[0]->options[0], $commandInteraction->getOption('foo.bar'));
    }

    public function testGetSubCommandName(): void
    {
        $dataMapper = DataMapperFake::get();

        /** @var InteractionCreate */
        $interactionCreate = $dataMapper->map(
            (object) [
                'id' => '::interaction id::',
                'token' => '::token::',
                'application_id' => '::application id::',
                'data' => (object) [
                    'options' => [
                        (object) [
                            'name' => '::option name::',
                            'type' => 1,
                        ]
                    ],
                ],
            ],
            InteractionCreate::class
        );

        $commandInteraction = new CommandInteraction($interactionCreate, DiscordFake::get());

        $this->assertEquals('::option name::', $commandInteraction->getSubCommandName());
    }

    public function testGetSubCommandGroupName(): void
    {
        $dataMapper = DataMapperFake::get();

        /** @var InteractionCreate */
        $interactionCreate = $dataMapper->map(
            (object) [
                'id' => '::interaction id::',
                'token' => '::token::',
                'application_id' => '::application id::',
                'data' => (object) [
                    'options' => [
                        (object) [
                            'name' => 'group_name',
                            'type' => 2,
                            'options' => [
                                (object) [
                                    'name' => 'option_name',
                                    'type' => 1,
                                ]
                            ],
                        ],
                    ],
                ],
            ],
            InteractionCreate::class
        );

        $commandInteraction = new CommandInteraction($interactionCreate, DiscordFake::get());

        $this->assertEquals('group_name:option_name', $commandInteraction->getSubCommandName());
    }

    public function testGetSubCommandNameIsNullForRegularCommands(): void
    {
        $dataMapper = DataMapperFake::get();

        /** @var InteractionCreate */
        $interactionCreate = $dataMapper->map(
            (object) [
                'id' => '::interaction id::',
                'token' => '::token::',
                'application_id' => '::application id::',
                'data' => (object) [
                    'options' => [
                        (object) [
                            'name' => '::option name::',
                            'type' => 3,
                        ]
                    ],
                ],
            ],
            InteractionCreate::class
        );

        $commandInteraction = new CommandInteraction($interactionCreate, DiscordFake::get());

        $this->assertNull($commandInteraction->getSubCommandName());
    }
}
