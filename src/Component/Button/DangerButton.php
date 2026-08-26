<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component\Button;

use CyberWolf\Discord\Enums\ButtonStyle;

class DangerButton extends InteractionButton
{
    protected ButtonStyle $style = ButtonStyle::Danger;
}
