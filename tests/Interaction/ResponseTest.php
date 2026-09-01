<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Interaction;

use Tempcord\Discord\Enums\InteractionCallbackType;
use Tempcord\Discord\Enums\MessageFlag;
use Tempcord\Discord\Interaction\Helpers\ModalBuilder;
use Tempcord\Discord\Interaction\Response;
use Tempcord\Discord\Rest\Helpers\Channel\EmbedBuilder;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testAMessageCarriesItsText(): void
    {
        $response = Response::message('Pong!');

        $this->assertEquals(InteractionCallbackType::CHANNEL_MESSAGE_WITH_SOURCE, $response->getType());
        $this->assertEquals('Pong!', $response->getContent());
    }

    public function testAMessageMayBeAnEmbedInstead(): void
    {
        $embed = EmbedBuilder::new()->setTitle('::title::');
        $response = Response::message($embed);

        $this->assertEquals([$embed], $response->getEmbeds());
        $this->assertNull($response->getContent());
    }

    public function testAnEmptyMessageIsStillATypedResponse(): void
    {
        $response = Response::message();

        $this->assertEquals(InteractionCallbackType::CHANNEL_MESSAGE_WITH_SOURCE, $response->getType());
        $this->assertNull($response->getContent());
        $this->assertNull($response->getEmbeds());
    }

    public function testAnEphemeralMessageIsFlagged(): void
    {
        $response = Response::ephemeral('only you');

        $this->assertEquals(InteractionCallbackType::CHANNEL_MESSAGE_WITH_SOURCE, $response->getType());
        $this->assertEquals(MessageFlag::EPHEMERAL->value, $response->getFlags());
    }

    public function testAnUpdateReplacesTheMessage(): void
    {
        $this->assertEquals(
            InteractionCallbackType::UPDATE_MESSAGE,
            Response::update('changed')->getType()
        );
    }

    /**
     * A modal cannot be sent as any other kind of response, so setting one has
     * to set the type as well.
     */
    public function testAModalSetsItsOwnType(): void
    {
        $modal = ModalBuilder::new()->setCustomId('::id::')->setTitle('::title::');
        $response = Response::modal($modal);

        $this->assertEquals(InteractionCallbackType::MODAL, $response->getType());
        $this->assertEquals($modal, $response->getModal());
    }

    public function testDeferringSaysNothingYet(): void
    {
        $response = Response::defer();

        $this->assertEquals(
            InteractionCallbackType::DEFERRED_CHANNEL_MESSAGE_WITH_SOURCE,
            $response->getType()
        );
        $this->assertNull($response->getFlags());
    }

    public function testDeferringMayBeEphemeral(): void
    {
        $this->assertEquals(MessageFlag::EPHEMERAL->value, Response::defer(true)->getFlags());
    }

    public function testDeferringAnUpdateLeavesTheMessageAlone(): void
    {
        $this->assertEquals(
            InteractionCallbackType::DEFERRED_UPDATE_MESSAGE,
            Response::deferUpdate()->getType()
        );
    }

    /**
     * What comes back is the builder, so anything the factory does not name is
     * still one chained call away.
     */
    public function testTheBuilderIsStillOpenForMore(): void
    {
        $embed = EmbedBuilder::new()->setTitle('::title::');
        $response = Response::ephemeral('text')->addEmbed($embed);

        $this->assertEquals('text', $response->getContent());
        $this->assertEquals([$embed], $response->getEmbeds());
        $this->assertEquals(MessageFlag::EPHEMERAL->value, $response->getFlags());
    }
}
