<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

class GatewayBot
{
    public string $url;
    public int $shards;
    public SessionStartLimit $session_start_limit;
}
