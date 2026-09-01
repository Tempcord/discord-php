<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Interaction;

use CyberWolf\Discord\Discord;
use CyberWolf\Discord\Gateway\Events\InteractionCreate;
use CyberWolf\Discord\Interaction\Concerns\OpensModal;
use CyberWolf\Discord\Interaction\Concerns\RespondsToInteraction;
use CyberWolf\Discord\Interaction\Concerns\UpdatesMessage;

class ButtonInteraction
{
    use RespondsToInteraction;
    use UpdatesMessage;
    use OpensModal;

    public function __construct(public readonly InteractionCreate $interaction, private Discord $discord)
    {
    }
}
