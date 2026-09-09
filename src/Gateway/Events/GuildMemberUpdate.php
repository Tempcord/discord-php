<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Events;

use Carbon\Carbon;
use Tempcord\Discord\Attributes\RequiresIntent;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Parts\GuildMember;
use Tempcord\Discord\Parts\User;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-member-update
 */
#[RequiresIntent(Intent::GUILD_MEMBERS)]
class GuildMemberUpdate
{
    public string $guild_id;

    /**
     * @var string[]
     */
    public array $roles;

    public User $user;
    public ?string $nick = null;
    public ?string $avatar = null;
    public ?Carbon $joined_at = null;
    public ?Carbon $premium_since = null;
    public ?bool $deaf = null;
    public ?bool $mute = null;
    public ?bool $pending = null;
    public ?Carbon $communication_disabled_until = null;

    /**
     * The member as it was immediately before this gateway payload.
     *
     * Discord sends only changed fields for GUILD_MEMBER_UPDATE. Tempcord's
     * cache subscriber fills this from its cache before applying the payload,
     * so an application listener can reliably diff roles, nicknames and
     * timeouts without keeping a second cache of its own. Null means this
     * member was unknown to the cache when Discord sent the update.
     */
    public ?GuildMember $oldMember = null;

    /**
     * The complete, merged member after this gateway payload was applied.
     *
     * Unlike the event object itself, this contains fields Discord omitted
     * from the partial update, such as joined_at and existing profile data.
     */
    public ?GuildMember $newMember = null;
}
