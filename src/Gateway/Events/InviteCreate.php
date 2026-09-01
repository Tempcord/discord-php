<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Carbon\Carbon;
use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Enums\TargetType;
use Tempcord\Discord\Parts\Application;
use Tempcord\Discord\Parts\User;

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
