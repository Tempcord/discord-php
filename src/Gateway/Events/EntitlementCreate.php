<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Parts\Entitlement;

/**
 * Entitlement events are not gated behind an intent.
 *
 * @see https://discord.com/developers/docs/events/gateway-events#entitlement-create
 */
class EntitlementCreate extends Entitlement
{
}
