<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Interaction;

use CyberWolf\Discord\Discord;
use CyberWolf\Discord\Gateway\Events\InteractionCreate;
use CyberWolf\Discord\Interaction\Helpers\InteractionCallbackBuilder;
use React\Promise\PromiseInterface;

class ButtonInteraction
{
    public function __construct(public readonly InteractionCreate $interaction, private Discord $discord)
    {
    }

    public function createInteractionResponse(
        InteractionCallbackBuilder $interactionCallbackBuilder
    ): PromiseInterface {
        return $this->discord->rest->webhook->createInteractionResponse(
            $this->interaction->id,
            $this->interaction->token,
            $interactionCallbackBuilder
        );
    }
}
