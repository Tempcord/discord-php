<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\ActionType;

/**
 * @see https://discord.com/developers/docs/resources/auto-moderation#auto-moderation-action-object
 */
class AutoModerationAction
{
    public ActionType $type;
    public ?AutoModerationActionMetadata $metadata = null;
}
