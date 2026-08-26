<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Parts\Subscription;

/**
 * Subscription events are not gated behind an intent.
 *
 * @see https://discord.com/developers/docs/events/gateway-events#subscription-delete
 */
class SubscriptionDelete extends Subscription
{
}
