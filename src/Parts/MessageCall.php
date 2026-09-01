<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;

/**
 * @see https://discord.com/developers/docs/resources/message#message-call-object
 */
class MessageCall
{
    /**
     * @var string[]
     */
    public array $participants;
    public Carbon $ended_timestamp;
}
