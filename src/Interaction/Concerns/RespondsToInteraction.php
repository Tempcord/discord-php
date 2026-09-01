<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Interaction\Concerns;

use CyberWolf\Discord\Enums\MessageFlag;
use CyberWolf\Discord\Interaction\Helpers\InteractionCallbackBuilder;
use CyberWolf\Discord\Interaction\Response;
use CyberWolf\Discord\Rest\Helpers\Channel\EmbedBuilder;
use CyberWolf\Discord\Rest\Helpers\Webhook\EditWebhookBuilder;
use CyberWolf\Discord\Rest\Helpers\Webhook\WebhookBuilder;
use React\Promise\PromiseInterface;

/**
 * Answering an interaction, and everything that follows the answer.
 *
 * Discord gives an interaction one initial response and then treats anything
 * further as a webhook against its token, which is two different endpoints for
 * what reads as one conversation. Both live here so a handler does not have to
 * keep track of which it is on.
 */
trait RespondsToInteraction
{
    public function createInteractionResponse(
        InteractionCallbackBuilder $interactionCallbackBuilder
    ): PromiseInterface {
        return $this->discord->rest->webhook->createInteractionResponse(
            $this->interaction->id,
            $this->interaction->token,
            $interactionCallbackBuilder
        );
    }

    /**
     * Answers the interaction.
     *
     * Takes the text, an embed, or a fully built response for anything more
     * involved — components, files, several embeds. A built response is sent as
     * it stands, so $ephemeral is ignored there: say it on the response itself.
     */
    public function reply(
        string|EmbedBuilder|InteractionCallbackBuilder $content,
        bool $ephemeral = false,
    ): PromiseInterface {
        if ($content instanceof InteractionCallbackBuilder) {
            return $this->createInteractionResponse($content);
        }

        return $this->createInteractionResponse(
            $ephemeral ? Response::ephemeral($content) : Response::message($content)
        );
    }

    /**
     * Says the answer is coming, so it can take longer than Discord's three
     * seconds. The answer itself then goes out through editReply().
     */
    public function defer(bool $ephemeral = false): PromiseInterface
    {
        return $this->createInteractionResponse(Response::defer($ephemeral));
    }

    public function getInteractionResponse(): PromiseInterface
    {
        return $this->discord->rest->webhook->getOriginalInteractionResponse(
            $this->interaction->application_id,
            $this->interaction->token
        );
    }

    public function editInteractionResponse(EditWebhookBuilder $webhookBuilder): PromiseInterface
    {
        return $this->discord->rest->webhook->editOriginalInteractionResponse(
            $this->interaction->application_id,
            $this->interaction->token,
            $webhookBuilder
        );
    }

    public function deleteInteractionResponse(): PromiseInterface
    {
        return $this->discord->rest->webhook->deleteOriginalInteractionResponse(
            $this->interaction->application_id,
            $this->interaction->token
        );
    }

    /**
     * Rewrites the answer already given, which is how a deferred interaction
     * finally says something.
     */
    public function editReply(string|EmbedBuilder|EditWebhookBuilder $content): PromiseInterface
    {
        return $this->editInteractionResponse(
            $content instanceof EditWebhookBuilder
                ? $content
                : $this->fill(EditWebhookBuilder::new(), $content)
        );
    }

    public function deleteReply(): PromiseInterface
    {
        return $this->deleteInteractionResponse();
    }

    /**
     * Sends another message under the same interaction, after the first answer.
     */
    public function followUp(
        string|EmbedBuilder|WebhookBuilder $content,
        bool $ephemeral = false,
    ): PromiseInterface {
        if (!$content instanceof WebhookBuilder) {
            $content = $this->fill(WebhookBuilder::new(), $content);

            if ($ephemeral) {
                $content->setFlags(MessageFlag::EPHEMERAL->value);
            }
        }

        return $this->discord->rest->webhook->execute(
            $this->interaction->application_id,
            $this->interaction->token,
            $content
        );
    }

    /**
     * @template T of EditWebhookBuilder|WebhookBuilder
     * @param T $builder
     * @return T
     */
    private function fill(object $builder, string|EmbedBuilder $content): object
    {
        return is_string($content)
            ? $builder->setContent($content)
            : $builder->addEmbed($content);
    }
}
