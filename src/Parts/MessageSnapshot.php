<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Mapping\ArrayMapping;

/**
 * @see https://discord.com/developers/docs/resources/message#message-snapshot-object
 */
class MessageSnapshot
{
    public Message $message;
}
