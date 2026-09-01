<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Mapping\ArrayMapping;

/**
 * @see https://discord.com/developers/docs/resources/poll#get-answer-voters
 */
class PollAnswerVoters
{
    /**
     * @var User[]
     */
    #[ArrayMapping(User::class)]
    public array $users;
}
