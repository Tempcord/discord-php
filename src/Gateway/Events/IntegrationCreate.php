<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Parts\Integration;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#integration-create
 */
#[RequiresIntent(Intent::GUILD_INTEGRATIONS)]
class IntegrationCreate extends Integration
{
    public string $guild_id;
}
