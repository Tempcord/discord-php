<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\AuditLogEvents;
use CyberWolf\Discord\Mapping\ArrayMapping;

class AuditLogEntry
{
    public ?string $target_id;
    /**
     * @var AuditLogChange[]
     */
    #[ArrayMapping(AuditLogChange::class)]
    public ?array $changes;
    public ?string $user_id;
    public string $id;
    public AuditLogEvents $action_type;
    public ?OptionalAuditEntryInfo $options;
    public ?string $reason;
}
