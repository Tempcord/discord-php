<?php

declare(strict_types=1);

namespace Tempcord\Discord\Interaction;

use Tempcord\Discord\Discord;
use Tempcord\Discord\Gateway\Events\InteractionCreate;
use Tempcord\Discord\Interaction\Concerns\OpensModal;
use Tempcord\Discord\Interaction\Concerns\RespondsToInteraction;
use Tempcord\Discord\Interaction\Concerns\UpdatesMessage;

class ButtonInteraction
{
    use RespondsToInteraction;
    use UpdatesMessage;
    use OpensModal;

    public function __construct(public readonly InteractionCreate $interaction, private Discord $discord)
    {
    }
}
