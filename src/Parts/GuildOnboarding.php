<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\GuildOnboardingMode;
use CyberWolf\Discord\Mapping\ArrayMapping;

/**
 * @see https://discord.com/developers/docs/resources/guild#guild-onboarding-object
 */
class GuildOnboarding
{
    public string $guild_id;
    /**
     * @var OnboardingPrompt[]
     */
    #[ArrayMapping(OnboardingPrompt::class)]
    public array $prompts;
    /** @var string[] */
    public array $default_channel_ids;
    public bool $enabled;
    public GuildOnboardingMode $mode;
}
