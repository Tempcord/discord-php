<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\MessageReferenceType;

class MessageReference
{
    public ?MessageReferenceType $type = null;
    public ?string $message_id = null;
    public ?string $channel_id = null;
    public ?string $guild_id = null;
    public ?bool $fail_if_not_exists = null;
}
