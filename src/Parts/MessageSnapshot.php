<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Mapping\ArrayMapping;

/**
 * @see https://discord.com/developers/docs/resources/message#message-snapshot-object
 */
class MessageSnapshot
{
    public Message $message;
}
