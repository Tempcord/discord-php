<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Interaction;

use CyberWolf\Discord\Enums\InteractionCallbackType;
use CyberWolf\Discord\Enums\MessageFlag;
use CyberWolf\Discord\Interaction\Helpers\InteractionCallbackBuilder;
use CyberWolf\Discord\Interaction\Helpers\ModalBuilder;
use CyberWolf\Discord\Rest\Helpers\Channel\EmbedBuilder;

/**
 * The ways an interaction may be answered.
 *
 * Every response Discord accepts is an InteractionCallbackBuilder carrying the
 * right callback type, and getting that type wrong is not reported — Discord
 * simply refuses the response. Naming each one here means the type is chosen by
 * the method rather than remembered by the caller, and what comes back is still
 * the builder, so anything else it can carry is still one chained call away.
 */
final class Response
{
    /**
     * A message in the channel the interaction came from.
     */
    public static function message(string|EmbedBuilder|null $content = null): InteractionCallbackBuilder
    {
        return self::build(InteractionCallbackType::CHANNEL_MESSAGE_WITH_SOURCE, $content);
    }

    /**
     * A message only the person who triggered the interaction can see.
     */
    public static function ephemeral(string|EmbedBuilder|null $content = null): InteractionCallbackBuilder
    {
        return self::message($content)->setFlags(MessageFlag::EPHEMERAL->value);
    }

    /**
     * Replaces the message the component being answered lives on.
     */
    public static function update(string|EmbedBuilder|null $content = null): InteractionCallbackBuilder
    {
        return self::build(InteractionCallbackType::UPDATE_MESSAGE, $content);
    }

    public static function modal(ModalBuilder $modal): InteractionCallbackBuilder
    {
        return InteractionCallbackBuilder::new()->setModal($modal);
    }

    /**
     * Buys time: Discord shows the bot as thinking and waits for the real reply,
     * which then goes out as an edit rather than as a new response.
     */
    public static function defer(bool $ephemeral = false): InteractionCallbackBuilder
    {
        $response = self::build(InteractionCallbackType::DEFERRED_CHANNEL_MESSAGE_WITH_SOURCE);

        return $ephemeral
            ? $response->setFlags(MessageFlag::EPHEMERAL->value)
            : $response;
    }

    /**
     * Buys time without the message the component lives on visibly changing.
     */
    public static function deferUpdate(): InteractionCallbackBuilder
    {
        return self::build(InteractionCallbackType::DEFERRED_UPDATE_MESSAGE);
    }

    private static function build(
        InteractionCallbackType $type,
        string|EmbedBuilder|null $content = null,
    ): InteractionCallbackBuilder {
        $response = InteractionCallbackBuilder::new()->setType($type);

        if (is_string($content)) {
            return $response->setContent($content);
        }

        if ($content instanceof EmbedBuilder) {
            return $response->addEmbed($content);
        }

        return $response;
    }
}
