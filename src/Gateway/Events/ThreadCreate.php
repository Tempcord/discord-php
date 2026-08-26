<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Parts\Channel;
use CyberWolf\Discord\Parts\ThreadMember;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#thread-create
 */
#[RequiresIntent(Intent::GUILDS)]
class ThreadCreate extends Channel
{
    public ?bool $newly_created;
    public ?ThreadMember $member;
}
