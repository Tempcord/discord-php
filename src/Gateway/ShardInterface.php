<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway;

interface ShardInterface
{
    public function getShardSettings(): array;
}
