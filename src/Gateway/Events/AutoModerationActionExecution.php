<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Enums\AutoModerationRuleTriggerType;
use Tempcord\Discord\Parts\AutoModerationAction;

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
    public ?string $channel_id = null;
    public ?string $message_id = null;
    public ?string $alert_system_message_id = null;
    public ?string $content = null;
    public ?string $matched_keyword = null;
    public ?string $matched_content = null;
}
