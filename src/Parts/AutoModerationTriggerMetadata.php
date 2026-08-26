<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Enums\AutoModerationKeywordPresetType;
use CyberWolf\Discord\Mapping\ArrayMapping;

class AutoModerationTriggerMetadata
{
    /**
     * @var string[]
     */
    public array $keyword_filter;
    /**
     * @var string[]
     */
    public array $regex_patterns;
    /**
     * @var AutoModerationKeywordPresetType[]
     */
    #[ArrayMapping(AutoModerationKeywordPresetType::class)]
    public array $presets;
    /**
     * @var string[]
     */
    public array $allow_list;
    public int $mention_total_limit;
    public bool $mention_raid_protection_enabled;
}
