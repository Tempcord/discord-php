<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Enums\AutoModerationRuleTriggerType;
use CyberWolf\Discord\Parts\AutoModerationAction;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#auto-moderation-action-execution
 */
#[RequiresIntent(Intent::AUTO_MODERATION_EXECUTION)]
class AutoModerationActionExecution
{
    public string $guild_id;
    public AutoModerationAction $action;
    public string $rule_id;
    public AutoModerationRuleTriggerType $rule_trigger_types;
    public string $user_id;
    public ?string $channel_id;
    public ?string $message_id;
    public ?string $alert_system_message_id;
    public ?string $content;
    public ?string $matched_keyword;
    public ?string $matched_content;
}
