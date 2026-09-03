<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Parts\ThreadMember;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#thread-members-update
 */
#[RequiresIntent(Intent::GUILDS)]
class ThreadMemberUpdate
{
    public string $id;
    public ?string $guild_id = null;
    public int $member_count;

    /**
     * @var ThreadMember[]
     */
    #[ArrayMapping(ThreadMember::class)]
    public ?array $added_members = null;

    /**
     * @var string[]
     */
    public ?array $removed_member_ids = null;
}
