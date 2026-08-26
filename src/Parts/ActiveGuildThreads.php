<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Mapping\ArrayMapping;

class ActiveGuildThreads
{
    /**
     * @var Channel[]
     */
    #[ArrayMapping(Channel::class)]
    public array $threads;

    /**
     * @var ThreadMember[]
     */
    #[ArrayMapping(ThreadMember::class)]
    public array $members;
}
