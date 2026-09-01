<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Mapping\ArrayMapping;

class Presence
{
    public User $user;
    public string $guild_id;
    public string $status;
    /**
     * @var Activity[]
     */
    #[ArrayMapping(Activity::class)]
    public ?array $activities;
    public ClientStatus $client_status;
}
