<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use Carbon\Carbon;
use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Enums\TargetType;
use CyberWolf\Discord\Parts\Application;
use CyberWolf\Discord\Parts\User;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#invite-create
 */
#[RequiresIntent(Intent::GUILD_INVITES)]
class InviteCreate
{
    public string $channel_id;
    public string $code;
    public Carbon $created_at;
    public ?string $guild_id;
    public ?User $inviter;
    public int $max_age;
    public int $max_uses;
    public TargetType $target_type;
    public ?User $target_user;
    public ?Application $target_application;
    public bool $temporary;
    public bool $uses;
}
