<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;

class ActivityTimestamps
{
    public ?Carbon $start;
    public ?Carbon $end;
}
