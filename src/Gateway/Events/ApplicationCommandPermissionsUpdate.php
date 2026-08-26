<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Parts\ApplicationCommandPermissions;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#application-command-permissions-update
 */
#[RequiresIntent(Intent::AUTO_MODERATION_CONFIGURATION)]
class ApplicationCommandPermissionsUpdate extends ApplicationCommandPermissions
{
}
