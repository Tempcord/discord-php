<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\ChannelType;

class ChannelMention
{
    public string $id;
    public string $guild_id;
    public ChannelType $type;
    public string $name;
}
