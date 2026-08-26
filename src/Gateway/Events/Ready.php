<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Gateway\Objects\Payload;
use CyberWolf\Discord\Mapping\ArrayMapping;
use CyberWolf\Discord\Parts\Application;
use CyberWolf\Discord\Parts\UnavailableGuild;
use CyberWolf\Discord\Parts\User;

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
