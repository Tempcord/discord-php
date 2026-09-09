<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\Message;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#message-delete-bulk
 */
#[RequiresIntent(Intent::GUILD_MESSAGES)]
class MessageDeleteBulk
{
    /**
     * @var string[]
     */
    public array $ids;

    public string $channel_id;
    public ?string $guild_id = null;

    /** @var list<Message> Cached messages that were present before deletion. */
    public array $oldMessages = [];
}
