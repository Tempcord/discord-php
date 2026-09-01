<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\AuditLogEntry;

/**
 * @see https://discord.com/developers/docs/events/gateway-events#guild-audit-log-entry-create
 */
#[RequiresIntent(Intent::GUILD_MODERATION)]
class GuildAuditLogEntryCreate extends AuditLogEntry
{
    public string $guild_id;
}
