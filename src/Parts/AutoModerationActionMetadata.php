<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class AutoModerationActionMetadata
{
    public ?string $channel_id;
    public ?int $duration_seconds;
    public ?string $custom_message;
}
