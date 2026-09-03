<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Mapping\ArrayMapping;

class WelcomeScreen
{
    public ?string $description = null;
    /**
     * @var WelcomeScreenChannel[]
     */
    #[ArrayMapping(WelcomeScreenChannel::class)]
    public array $welcome_channels;
}
