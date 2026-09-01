<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\AutoModerationRuleTriggerType;
use Tempcord\Discord\Enums\AutoModerationRuleEventType;
use Tempcord\Discord\Mapping\ArrayMapping;

class AutoModerationRuleObject
{
    public string $id;
    public string $guild_id;
    public string $name;
    public string $creator_id;
    public AutoModerationRuleEventType $event_type;
    public AutoModerationRuleTriggerType $trigger_type;
    public AutoModerationTriggerMetadata $trigger_metadata;
    /**
     * @var AutoModerationActionStructure[]
     */
    #[ArrayMapping(AutoModerationActionStructure::class)]
    public array $actions;
    public bool $enabled;
    /**
     * @var string[]
     */
    public array $exempt_roles;
    /**
     * @var string[]
     */
    public array $exempt_channels;
}
