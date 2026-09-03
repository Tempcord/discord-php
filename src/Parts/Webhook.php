<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class Webhook
{
    public string $id;
    public int $type;
    public ?string $guild_id = null;
    public ?string $channel_id = null;
    public ?User $user = null;
    public ?string $name = null;
    public ?string $avatar = null;
    public ?string $token = null;
    public ?string $application_id = null;
    public ?Guild $source_guild = null;
    public ?Channel $source_channel = null;
    public ?string $url = null;
}
