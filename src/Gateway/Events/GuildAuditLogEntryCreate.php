<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Parts\AuditLogEntry;

/**
 * @see https://discord.com/developers/docs/events/gateway-events#guild-audit-log-entry-create
 */
#[RequiresIntent(Intent::GUILD_MODERATION)]
class GuildAuditLogEntryCreate extends AuditLogEntry
{
    public string $guild_id;
}
