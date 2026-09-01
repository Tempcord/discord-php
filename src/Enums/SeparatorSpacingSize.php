<?php

declare(strict_types=1);

namespace Tempcord\Discord\Enums;

/**
 * @see https://discord.com/developers/docs/components/reference#separator
 */
enum SeparatorSpacingSize: int
{
    case SMALL = 1;
    case LARGE = 2;
}
