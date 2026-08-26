<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Enums;

enum ThreadSortingMode: string
{
    case RELEVANCE = 'relevance';
    case CREATION_TIME = 'creation_time';
    case LAST_MESSAGE_TIME = 'last_message_time';
    case ARCHIVE_TIME = 'archive_time';
}
