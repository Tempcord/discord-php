<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\ConnectionService;
use Tempcord\Discord\Enums\ConnectionVisibility;
use Tempcord\Discord\Mapping\ArrayMapping;

class Connection
{
    public string $id;
    public string $name;
    public ConnectionService $type;

    /**
     * @var Integration[]
     */
    #[ArrayMapping(Integration::class)]
    public array $integrations;

    public bool $verified;
    public bool $friend_sync;
    public bool $show_activity;
    public bool $two_way_link;
    public ConnectionVisibility $visibility;
}
