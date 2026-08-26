<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Events;

use Carbon\Carbon;
use CyberWolf\Discord\Attributes\RequiresIntent;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Mapping\ArrayMapping;
use CyberWolf\Discord\Parts\Channel;
use CyberWolf\Discord\Parts\Guild;
use CyberWolf\Discord\Parts\GuildMember;
use CyberWolf\Discord\Parts\GuildScheduledEvent;
use CyberWolf\Discord\Parts\Presence;
use CyberWolf\Discord\Parts\StageInstance;
use CyberWolf\Discord\Parts\VoiceState;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-create
 */
#[RequiresIntent(Intent::GUILDS)]
class GuildCreate extends Guild
{
    public Carbon $joined_at;
    public bool $large;
    public ?bool $unavailable;
    public int $member_count;

    /** @var VoiceState[] */
    #[ArrayMapping(VoiceState::class)]
    public array $voice_states;

    /** @var GuildMember[] */
    #[ArrayMapping(GuildMember::class)]
    public array $members;

    /** @var Channel[] */
    #[ArrayMapping(Channel::class)]
    public array $channels;

    /** @var Channel[] */
    #[ArrayMapping(Channel::class)]
    public array $threads;

    /** @var Presence[] */
    #[RequiresIntent(Intent::GUILD_PRESENCES)]
    #[ArrayMapping(Presence::class)]
    public array $presences;

    /** @var StageInstance[] */
    #[ArrayMapping(StageInstance::class)]
    public array $stage_instances;

    /** @var GuildScheduledEvent[] */
    #[ArrayMapping(GuildScheduledEvent::class)]
    public array $guild_scheduled_events;
}
