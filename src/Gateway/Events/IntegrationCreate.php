<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Integration;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#integration-create
 */
#[RequiresIntent(Intent::GUILD_INTEGRATIONS)]
class IntegrationCreate extends Integration
{
    public string $guild_id;
}
