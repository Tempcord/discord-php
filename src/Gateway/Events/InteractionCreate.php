<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Interaction;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#interaction-create
 */
#[RequiresIntent(Intent::GUILD_INTEGRATIONS)]
class InteractionCreate extends Interaction
{
}
