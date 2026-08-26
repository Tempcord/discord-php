<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\MessageActivityType;

class MessageActivity
{
    public MessageActivityType $type;
    public ?string $party_id;
}
