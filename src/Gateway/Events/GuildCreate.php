<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Carbon\Carbon;
use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Mapping\ArrayMapping;
use Tempcord\Discord\Parts\Channel;
use Tempcord\Discord\Parts\Guild;
use Tempcord\Discord\Parts\GuildMember;
use Tempcord\Discord\Parts\GuildScheduledEvent;
use Tempcord\Discord\Parts\Presence;
use Tempcord\Discord\Parts\StageInstance;
use Tempcord\Discord\Parts\VoiceState;

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
