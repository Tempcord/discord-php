<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\AuditLogEvents;
use Tempcord\Discord\Mapping\ArrayMapping;

class AuditLogEntry
{
    public ?string $target_id = null;
    /**
     * @var AuditLogChange[]
     */
    #[ArrayMapping(AuditLogChange::class)]
    public ?array $changes = null;
    public ?string $user_id = null;
    public string $id;
    public AuditLogEvents $action_type;
    public ?OptionalAuditEntryInfo $options = null;
    public ?string $reason = null;
}
