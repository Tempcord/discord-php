<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Extension;

use CyberWolf\Discord\Discord;

interface Extension
{
    public function initialize(Discord $discord): void;
}
