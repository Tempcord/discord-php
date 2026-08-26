<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Parts\Interaction;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#interaction-create
 */
#[RequiresIntent(Intent::GUILD_INTEGRATIONS)]
class InteractionCreate extends Interaction
{
}
