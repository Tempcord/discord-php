<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Parts\ApplicationCommandPermissions;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#channel-delete
 */
#[RequiresIntent(Intent::AUTO_MODERATION_CONFIGURATION)]
class AutoModerationRuleDelete extends ApplicationCommandPermissions
{
}
