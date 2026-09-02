<?php

declare(strict_types=1);

namespace Tempcord\Discord\Enums;

/**
 * How Discord renders a timestamp.
 *
 * The client draws these in each reader's own timezone and locale, so a time
 * written this way is correct for everyone who sees it.
 *
 * @see https://discord.com/developers/docs/reference#message-formatting-timestamp-styles
 */
enum TimestampStyle: string
{
    /** 16:20 */
    case ShortTime = 't';

    /** 16:20:30 */
    case LongTime = 'T';

    /** 20/04/2021 */
    case ShortDate = 'd';

    /** 20 April 2021 */
    case LongDate = 'D';

    /** 20 April 2021 16:20 — what Discord uses when no style is given. */
    case ShortDateTime = 'f';

    /** Tuesday, 20 April 2021 16:20 */
    case LongDateTime = 'F';

    /** 2 months ago */
    case Relative = 'R';
}
