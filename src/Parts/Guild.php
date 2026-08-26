<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Bitwise\Bitwise;
use CyberWolf\Discord\Enums\ExplicitContentFilterLevel;
use CyberWolf\Discord\Enums\GuildFeature;
use CyberWolf\Discord\Enums\MessageNotificationLevel;
use CyberWolf\Discord\Enums\MfaLevel;
use CyberWolf\Discord\Enums\NsfwLevel;
use CyberWolf\Discord\Enums\PremiumTier;
use CyberWolf\Discord\Enums\VerificationLevel;
use CyberWolf\Discord\Mapping\ArrayMapping;

class Guild
{
    public string $id;
    public string $name;
    public ?string $icon;
    public ?string $icon_hash;
    public ?string $splash;
    public ?string $discovery_splash;
    public ?bool $owner;
    public string $owner_id;
    public ?string $permissions;
    public ?string $region;
    public ?string $afk_channel_id;
    public int $afk_timeout;
    public bool $widget_enabled;
    public ?string $widget_channel_id;
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
    public ?string $application_id;
    public ?string $system_channel_id;
    public Bitwise $system_channel_flags;
    public ?string $rules_channel_id;
    public ?int $max_presences;
    public ?int $max_members;
    public ?string $vanity_url_code;
    public ?string $description;
    public ?string $banner;
    public PremiumTier $premium_tier;
    public ?int $premium_subscription_count;
    public string $preferred_locale;
    public ?string $public_updates_channel_id;
    public ?int $max_video_channel_users;
    public ?int $approximate_member_count;
    public ?int $approximate_presence_count;
    public ?WelcomeScreen $welcome_screen;
    public NsfwLevel $nsfw_level;
    /**
     * @var Sticker[]
     */
    #[ArrayMapping(Sticker::class)]
    public ?array $stickers;
    public bool $premium_progress_bar_enabled;
    public ?string $safety_alerts_channel_id;
}
