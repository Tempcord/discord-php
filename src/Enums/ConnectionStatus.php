<?php

declare(strict_types=1);

namespace Tempcord\Discord\Enums;

enum ConnectionStatus: string
{
    case ONLINE = 'online';
    case IDLE = 'idle';
    case DO_NOT_DISTURB = 'dnd';
}
