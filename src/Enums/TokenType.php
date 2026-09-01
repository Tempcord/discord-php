<?php

declare(strict_types=1);

namespace Tempcord\Discord\Enums;

enum TokenType: string
{
    case BOT = 'Bot';
    case BEARER = 'Bearer';
}
