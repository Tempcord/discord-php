<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Attributes\Partial;
use CyberWolf\Discord\Mapping\ArrayMapping;

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
