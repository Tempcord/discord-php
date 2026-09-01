<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Gateway\Objects\Payload;
use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Parts\Application;
use Tempcord\Discord\Parts\UnavailableGuild;
use Tempcord\Discord\Parts\User;

class Ready extends Payload
{
    public int $v;
    public User $user;

    /** @var UnavailableGuild[] */
    #[ArrayMapping(UnavailableGuild::class)]
    public array $guilds;

    public string $session_id;
    public string $resume_gateway_url;
    public array $shard;
    public Application $application;
}
