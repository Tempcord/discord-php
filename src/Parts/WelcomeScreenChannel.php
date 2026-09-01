<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class WelcomeScreenChannel
{
    public string $channel_id;
    public string $description;
    public ?string $emoji_id;
    public ?string $emoji_name;
}
