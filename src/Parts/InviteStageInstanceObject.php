<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Attributes\Partial;
use Tempcord\Discord\Mapping\ArrayMapping;

class InviteStageInstanceObject
{
    /**
     * @var GuildMember[]
     */
    #[ArrayMapping(GuildMember::class)]
    public array $members;
    public int $participant_count;
    public int $speaker_count;
    public string $topic;
}
