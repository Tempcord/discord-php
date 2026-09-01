<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

/**
 * @see https://discord.com/developers/docs/resources/poll#poll-results-object-poll-answer-count-object-structure
 */
class PollAnswerCount
{
    public int $id;
    public int $count;
    public bool $me_voted;
}
