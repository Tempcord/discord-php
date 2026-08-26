<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Enums;

enum ThreadSearchTagSetting: string
{
    case MATCH_ALL = 'match_all';
    case MATCH_SOME = 'match_some';
}
