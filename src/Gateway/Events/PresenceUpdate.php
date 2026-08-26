<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Mapping\ArrayMapping;
use CyberWolf\Discord\Parts\Activity;
use CyberWolf\Discord\Parts\ClientStatus;
use CyberWolf\Discord\Parts\User;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#presence-update
 */
#[RequiresIntent(Intent::GUILD_PRESENCES)]
class PresenceUpdate
{
    public User $user;
    public string $guild_id;
    public string $status;

    /**
     * @var Activity[]
     */
    #[ArrayMapping(Activity::class)]
    public array $activities;

    public ClientStatus $clientStatus;
}
