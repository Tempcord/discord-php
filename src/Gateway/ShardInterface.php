<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway;

interface ShardInterface
{
    public function getShardSettings(): array;
}
