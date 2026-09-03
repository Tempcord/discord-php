<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Attributes\Partial;
use Tempcord\Discord\Mapping\ArrayMapping;

class AuditLog
{
    /**
     * @var ApplicationCommandPermissionObject[]
     */
    #[ArrayMapping(ApplicationCommandPermissionObject::class)]
    public ?array $application_commands = null;
    /**
     * @var AuditLogEntry[]
     */
    #[ArrayMapping(AuditLogEntry::class)]
    public ?array $audit_log_entries = null;
    /**
     * @var AutoModerationRule[]
     */
    #[ArrayMapping(AutoModerationRule::class)]
    public ?array $auto_moderation_rules = null;
    /**
     * @var GuildScheduledEvent[]
     */
    #[ArrayMapping(GuildScheduledEvent::class)]
    public ?array $guild_scheduled_events = null;
    /**
     * @var Integration[]
     */
    #[ArrayMapping(Integration::class)]
    public ?array $integrations = null;
    /**
     * @var Channel[]
     */
    #[ArrayMapping(Channel::class)]
    public ?array $threads = null;
    /**
     * @var User[]
     */
    #[ArrayMapping(User::class)]
    public ?array $users = null;
    /**
     * @var Webhook[]
     */
    #[ArrayMapping(Webhook::class)]
    public ?array $webhooks = null;
}
