<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\MessageActivityType;

class MessageActivity
{
    public MessageActivityType $type;
    public ?string $party_id = null;
}
