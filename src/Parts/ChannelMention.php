<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\ChannelType;

class ChannelMention
{
    public string $id;
    public string $guild_id;
    public ChannelType $type;
    public string $name;
}
