<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Parts\Activity;
use Tempcord\Discord\Parts\ClientStatus;
use Tempcord\Discord\Parts\User;

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
