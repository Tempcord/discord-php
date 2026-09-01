<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Mapping\ArrayMapping;

class Widget
{
    public string $id;
    public string $name;
    public ?string $instant_invite;

    /**
     * @var Channel[]
     */
    #[ArrayMapping(Channel::class)]
    public array $channels;

    /**
     * @var User[]
     */
    #[ArrayMapping(User::class)]
    public array $users;
    public int $presence_count;
}
