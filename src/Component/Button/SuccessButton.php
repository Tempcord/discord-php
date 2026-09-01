<?php

declare(strict_types=1);

namespace Tempcord\Discord\Component\Button;

use Tempcord\Discord\Enums\ButtonStyle;

class SuccessButton extends InteractionButton
{
    protected ButtonStyle $style = ButtonStyle::Success;
}
