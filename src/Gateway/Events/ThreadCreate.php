<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Channel;
use Tempcord\Discord\Parts\ThreadMember;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#thread-create
 */
#[RequiresIntent(Intent::GUILDS)]
class ThreadCreate extends Channel
{
    public ?bool $newly_created;
    public ?ThreadMember $member;
}
