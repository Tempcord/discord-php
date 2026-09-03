<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\InteractionContextType;
use Tempcord\Discord\Enums\InteractionType;

class Interaction
{
    public string $id;
    public string $application_id;
    public InteractionType $type;
    public ?InteractionData $data = null;
    public ?string $guild_id = null;
    /** @deprecated */
    public ?string $channel_id = null;
    public ?GuildMember $member = null;
    public User $user;
    public string $token;
    public int $version;
    public ?Message $message = null;
    public ?string $app_permissions = null;
    public ?string $locale = null;
    public string $guild_locale;
    public Channel $channel;
    public InteractionContextType $context;
    /**
     * @var string[]
     * @see https://discord.com/developers/docs/interactions/receiving-and-responding#interaction-object-authorizing-integration-owners-object
     */
    public array $authorizing_integration_owners;
}
