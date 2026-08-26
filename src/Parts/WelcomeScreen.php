<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Mapping\ArrayMapping;

class WelcomeScreen
{
    public ?string $description;
    /**
     * @var WelcomeScreenChannel[]
     */
    #[ArrayMapping(WelcomeScreenChannel::class)]
    public array $welcome_channels;
}
