<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Parts\Entitlement;

/**
 * Entitlement events are not gated behind an intent.
 *
 * @see https://discord.com/developers/docs/events/gateway-events#entitlement-create
 */
class EntitlementCreate extends Entitlement
{
}
