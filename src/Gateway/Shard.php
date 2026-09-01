<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway;

class Shard implements ShardInterface
{
    public function __construct(private int $shardId, private int $numShards)
    {
    }

    public function getShardSettings(): array
    {
        return [$this->shardId, $this->numShards];
    }
}
