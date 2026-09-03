<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Objects;

use JsonSerializable;

class Payload implements JsonSerializable
{
    public ?string $t = null;
    public ?int $s = null;
    public int $op;

    public $d;

    public function jsonSerialize(): mixed
    {
        return [
            't' => $this->t,
            's' => $this->s,
            'op' => $this->op,
            'd' => $this->d,
        ];
    }
}
