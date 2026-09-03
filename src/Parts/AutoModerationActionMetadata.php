<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class AutoModerationActionMetadata
{
    public ?string $channel_id = null;
    public ?int $duration_seconds = null;
    public ?string $custom_message = null;
}
