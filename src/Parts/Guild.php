<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Bitwise\Bitwise;
use Tempcord\Discord\Enums\ExplicitContentFilterLevel;
use Tempcord\Discord\Enums\GuildFeature;
use Tempcord\Discord\Enums\MessageNotificationLevel;
use Tempcord\Discord\Enums\MfaLevel;
use Tempcord\Discord\Enums\NsfwLevel;
use Tempcord\Discord\Enums\PremiumTier;
use Tempcord\Discord\Enums\VerificationLevel;
use Tempcord\Discord\Mapping\ArrayMapping;

class Guild
{
    public string $id;
    public string $name;
    public ?string $icon = null;
    public ?string $icon_hash = null;
    public ?string $splash = null;
    public ?string $discovery_splash = null;
    public ?bool $owner = null;
    public string $owner_id;
    public ?string $permissions = null;
    public ?string $region = null;
    public ?string $afk_channel_id = null;
    public int $afk_timeout;
    public bool $widget_enabled;
    public ?string $widget_channel_id = null;
    public VerificationLevel $verification_level;
    public MessageNotificationLevel $default_message_notifications;
    public ExplicitContentFilterLevel $explicit_content_filter;
    /**
     * @var Role[]
     */
    #[ArrayMapping(Role::class)]
    public array $roles;
    /**
     * @var Emoji[]
     */
    #[ArrayMapping(Emoji::class)]
    public array $emojis;
    /**
     * @var GuildFeature[]
     */
    #[ArrayMapping(GuildFeature::class)]
    public array $features;
    public MfaLevel $mfa_level;
    public ?string $application_id = null;
    public ?string $system_channel_id = null;
    public Bitwise $system_channel_flags;
    public ?string $rules_channel_id = null;
    public ?int $max_presences = null;
    public ?int $max_members = null;
    public ?string $vanity_url_code = null;
    public ?string $description = null;
    public ?string $banner = null;
    public PremiumTier $premium_tier;
    public ?int $premium_subscription_count = null;
    public string $preferred_locale;
    public ?string $public_updates_channel_id = null;
    public ?int $max_video_channel_users = null;
    public ?int $approximate_member_count = null;
    public ?int $approximate_presence_count = null;
    public ?WelcomeScreen $welcome_screen = null;
    public NsfwLevel $nsfw_level;
    /**
     * @var Sticker[]
     */
    #[ArrayMapping(Sticker::class)]
    public ?array $stickers = null;
    public bool $premium_progress_bar_enabled;
    public ?string $safety_alerts_channel_id = null;
}
