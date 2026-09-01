<?php

declare(strict_types=1);

namespace Tempcord\Discord\Interaction\Concerns;

use Tempcord\Discord\Interaction\Response;
use Tempcord\Discord\Rest\Helpers\Channel\EmbedBuilder;
use React\Promise\PromiseInterface;

/**
 * Answering by changing the message the interaction came from.
 *
 * Only interactions that started on a message can do this — a button, a select
 * menu, or a modal opened from one — which is why it is not on every
 * interaction.
 */
trait UpdatesMessage
{
    /**
     * Rewrites the message this interaction came from, in place.
     */
    public function update(string|EmbedBuilder $content): PromiseInterface
    {
        return $this->createInteractionResponse(Response::update($content));
    }

    /**
     * Acknowledges the interaction without the message visibly changing, so the
     * component stops spinning while the real work happens.
     */
    public function deferUpdate(): PromiseInterface
    {
        return $this->createInteractionResponse(Response::deferUpdate());
    }
}
