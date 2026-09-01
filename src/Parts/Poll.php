<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;
use Tempcord\Discord\Enums\PollLayoutType;
use Tempcord\Discord\Mapping\ArrayMapping;

/**
 * @see https://discord.com/developers/docs/resources/poll#poll-object
 */
class Poll
{
    public PollMediaObject $question;

    /**
     * @var PollAnswer[]
     */
    #[ArrayMapping(PollAnswer::class)]
    public array $answers;
    public ?Carbon $expiry;
    public bool $allow_multiselect;
    public PollLayoutType $layout_type;
    public PollResults $results;
}
