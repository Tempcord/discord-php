<?php

declare(strict_types=1);

namespace Tempcord\Discord\Extension;

use Tempcord\Discord\Discord;

interface Extension
{
    public function initialize(Discord $discord): void;
}
