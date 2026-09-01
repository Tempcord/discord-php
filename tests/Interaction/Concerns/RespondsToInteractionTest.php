<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Interaction\Concerns;

use CyberWolf\Discord\Enums\InteractionCallbackType;
use CyberWolf\Discord\Enums\MessageFlag;
use CyberWolf\Discord\Gateway\Events\InteractionCreate;
use CyberWolf\Discord\Interaction\ButtonInteraction;
use CyberWolf\Discord\Interaction\CommandInteraction;
use CyberWolf\Discord\Interaction\Helpers\InteractionCallbackBuilder;
use CyberWolf\Discord\Interaction\Helpers\ModalBuilder;
use CyberWolf\Discord\Interaction\ModalSubmitInteraction;
use CyberWolf\Discord\Rest\Helpers\Channel\EmbedBuilder;
use CyberWolf\Discord\Rest\Helpers\Webhook\EditWebhookBuilder;
use CyberWolf\Discord\Rest\Helpers\Webhook\WebhookBuilder;
use Fakes\CyberWolf\Discord\DiscordFake;
use Fakes\CyberWolf\Discord\PromiseFake;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;

/**
 * The convenience methods every interaction answers through.
 *
 * Exercised on a button, which carries all three concerns, and spot-checked on
 * the other kinds so the traits are known to actually be attached.
 */
class RespondsToInteractionTest extends MockeryTestCase
{
    private function interactionCreate(): InteractionCreate
    {
        $interactionCreate = new InteractionCreate();
        $interactionCreate->id = '::interaction id::';
        $interactionCreate->token = '::interaction token::';
        $interactionCreate->application_id = '::application id::';

        return $interactionCreate;
    }

    /**
     * Answers the interaction and hands back the response that was sent, so a
     * test can assert on what Discord would have been told.
     */
    private function captureResponse(callable $act): InteractionCallbackBuilder
    {
        $discord = DiscordFake::get();
        $sent = null;

        $discord->rest->webhook
            ->shouldReceive('createInteractionResponse')
            ->with('::interaction id::', '::interaction token::', Mockery::on(
                function (InteractionCallbackBuilder $response) use (&$sent) {
                    $sent = $response;

                    return true;
                }
            ))
            ->andReturn(PromiseFake::get('::result::'))
            ->once();

        $act(new ButtonInteraction($this->interactionCreate(), $discord));

        return $sent;
    }

    public function testReplyingSendsAVisibleMessage(): void
    {
        $response = $this->captureResponse(
            static fn (ButtonInteraction $interaction) => $interaction->reply('Pong!')
        );

        $this->assertEquals(InteractionCallbackType::CHANNEL_MESSAGE_WITH_SOURCE, $response->getType());
        $this->assertEquals('Pong!', $response->getContent());
        $this->assertNull($response->getFlags());
    }

    public function testReplyingTakesAnEmbed(): void
    {
        $embed = EmbedBuilder::new()->setTitle('::title::');

        $response = $this->captureResponse(
            static fn (ButtonInteraction $interaction) => $interaction->reply($embed)
        );

        $this->assertEquals([$embed], $response->getEmbeds());
    }

    /**
     * A handler that needs more than text or an embed builds the response
     * itself, and it must be passed through untouched.
     */
    public function testAFullyBuiltResponseIsSentAsIs(): void
    {
        $built = InteractionCallbackBuilder::new()
            ->setType(InteractionCallbackType::CHANNEL_MESSAGE_WITH_SOURCE)
            ->setContent('::built::')
            ->setTts(true);

        $response = $this->captureResponse(
            static fn (ButtonInteraction $interaction) => $interaction->reply($built)
        );

        $this->assertSame($built, $response);
    }

    public function testReplyingEphemerallyIsFlagged(): void
    {
        $response = $this->captureResponse(
            static fn (ButtonInteraction $interaction) => $interaction->reply('only you', ephemeral: true)
        );

        $this->assertEquals(MessageFlag::EPHEMERAL->value, $response->getFlags());
    }

    /**
     * A response built by hand carries its own flags, so the shorthand must not
     * quietly override what it was told.
     */
    public function testABuiltResponseIgnoresTheEphemeralShorthand(): void
    {
        $built = InteractionCallbackBuilder::new()
            ->setType(InteractionCallbackType::CHANNEL_MESSAGE_WITH_SOURCE)
            ->setContent('::built::');

        $response = $this->captureResponse(
            static fn (ButtonInteraction $interaction) => $interaction->reply($built, ephemeral: true)
        );

        $this->assertSame($built, $response);
        $this->assertNull($response->getFlags());
    }

    public function testDeferring(): void
    {
        $response = $this->captureResponse(
            static fn (ButtonInteraction $interaction) => $interaction->defer()
        );

        $this->assertEquals(
            InteractionCallbackType::DEFERRED_CHANNEL_MESSAGE_WITH_SOURCE,
            $response->getType()
        );
    }

    public function testDeferringEphemerally(): void
    {
        $response = $this->captureResponse(
            static fn (ButtonInteraction $interaction) => $interaction->defer(true)
        );

        $this->assertEquals(MessageFlag::EPHEMERAL->value, $response->getFlags());
    }

    public function testUpdatingReplacesTheMessageTheComponentSitsOn(): void
    {
        $response = $this->captureResponse(
            static fn (ButtonInteraction $interaction) => $interaction->update('changed')
        );

        $this->assertEquals(InteractionCallbackType::UPDATE_MESSAGE, $response->getType());
        $this->assertEquals('changed', $response->getContent());
    }

    public function testDeferringAnUpdate(): void
    {
        $response = $this->captureResponse(
            static fn (ButtonInteraction $interaction) => $interaction->deferUpdate()
        );

        $this->assertEquals(InteractionCallbackType::DEFERRED_UPDATE_MESSAGE, $response->getType());
    }

    public function testShowingAModal(): void
    {
        $modal = ModalBuilder::new()->setCustomId('::id::')->setTitle('::title::');

        $response = $this->captureResponse(
            static fn (ButtonInteraction $interaction) => $interaction->showModal($modal)
        );

        $this->assertEquals(InteractionCallbackType::MODAL, $response->getType());
        $this->assertEquals($modal, $response->getModal());
    }

    /**
     * Editing goes to the webhook against the interaction's token rather than
     * to the interaction itself, which is the part worth pinning down.
     */
    public function testEditingTheReplyGoesThroughTheWebhook(): void
    {
        $discord = DiscordFake::get();

        $discord->rest->webhook
            ->shouldReceive('editOriginalInteractionResponse')
            ->with('::application id::', '::interaction token::', Mockery::on(
                static fn (EditWebhookBuilder $builder) => $builder->getContent() === '::edited::'
            ))
            ->andReturn(PromiseFake::get('::result::'))
            ->once();

        new ButtonInteraction($this->interactionCreate(), $discord)->editReply('::edited::');
    }

    public function testEditingTheReplyTakesABuilder(): void
    {
        $discord = DiscordFake::get();
        $builder = EditWebhookBuilder::new()->setContent('::edited::');

        $discord->rest->webhook
            ->shouldReceive('editOriginalInteractionResponse')
            ->with('::application id::', '::interaction token::', $builder)
            ->andReturn(PromiseFake::get('::result::'))
            ->once();

        new ButtonInteraction($this->interactionCreate(), $discord)->editReply($builder);
    }

    public function testDeletingTheReply(): void
    {
        $discord = DiscordFake::get();

        $discord->rest->webhook
            ->shouldReceive('deleteOriginalInteractionResponse')
            ->with('::application id::', '::interaction token::')
            ->andReturn(PromiseFake::get('::result::'))
            ->once();

        new ButtonInteraction($this->interactionCreate(), $discord)->deleteReply();
    }

    public function testFollowingUpExecutesTheInteractionWebhook(): void
    {
        $discord = DiscordFake::get();

        $discord->rest->webhook
            ->shouldReceive('execute')
            ->with('::application id::', '::interaction token::', Mockery::on(
                static fn (WebhookBuilder $builder) => $builder->getContent() === '::more::'
            ))
            ->andReturn(PromiseFake::get('::result::'))
            ->once();

        new ButtonInteraction($this->interactionCreate(), $discord)->followUp('::more::');
    }

    /**
     * Every kind of interaction can be replied to, so the trait has to be on
     * all of them and not only where it was first needed.
     */
    public function testEveryInteractionCanReply(): void
    {
        foreach ([CommandInteraction::class, ButtonInteraction::class, ModalSubmitInteraction::class] as $class) {
            $discord = DiscordFake::get();

            $discord->rest->webhook
                ->shouldReceive('createInteractionResponse')
                ->andReturn(PromiseFake::get('::result::'))
                ->once();

            new $class($this->interactionCreate(), $discord)->reply('Pong!');
        }
    }

    /**
     * A submitted modal cannot open another one, and that is expressed by the
     * method not being there at all.
     */
    public function testASubmittedModalCannotOpenAnother(): void
    {
        $this->assertFalse(method_exists(ModalSubmitInteraction::class, 'showModal'));
    }

    /**
     * A command has no message to update, so it must not offer to.
     */
    public function testACommandCannotUpdateAMessage(): void
    {
        $this->assertFalse(method_exists(CommandInteraction::class, 'update'));
        $this->assertFalse(method_exists(CommandInteraction::class, 'deferUpdate'));
    }

    public function testFollowingUpMayBeEphemeral(): void
    {
        $discord = DiscordFake::get();

        $discord->rest->webhook
            ->shouldReceive('execute')
            ->with('::application id::', '::interaction token::', Mockery::on(
                static fn (WebhookBuilder $builder) => $builder->getFlags() === MessageFlag::EPHEMERAL->value
            ))
            ->andReturn(PromiseFake::get('::result::'))
            ->once();

        new ButtonInteraction($this->interactionCreate(), $discord)->followUp('::more::', ephemeral: true);
    }

    /**
     * The shorthand is gone: there is one way to answer, and whether only the
     * presser sees it is an argument rather than a second method.
     */
    public function testThereIsNoSeparateEphemeralReply(): void
    {
        $this->assertFalse(method_exists(ButtonInteraction::class, 'replyEphemeral'));
    }
}
