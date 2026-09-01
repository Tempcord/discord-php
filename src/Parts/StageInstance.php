<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\PrivacyLevel;

class StageInstance
{
    public string $id;
    public string $guild_id;
    public string $channel_id;
    public string $topic;
    public PrivacyLevel $privacy_level;
    public bool $discoverable_disabled;
    public ?string $guild_scheduled_event_id;
}
