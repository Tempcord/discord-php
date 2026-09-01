<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Mapping\ArrayMapping;

/**
 * The response to listing a channel's archived threads.
 *
 * Discord answers these endpoints with an object rather than a bare list, so
 * the threads arrive alongside the caller's membership of them and a flag
 * saying whether another page is worth asking for.
 *
 * @see https://discord.com/developers/docs/resources/channel#list-public-archived-threads
 */
class ArchivedThreads
{
    /** @var Channel[] */
    #[ArrayMapping(Channel::class)]
    public array $threads;

    /**
     * A thread member object for each returned thread the current user has
     * joined.
     *
     * @var ThreadMember[]
     */
    #[ArrayMapping(ThreadMember::class)]
    public array $members;

    /**
     * Whether there are potentially more threads to be had from a further call.
     */
    public bool $has_more;
}
