<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;
use Tempcord\Discord\Bitwise\Bitwise;
use Tempcord\Discord\Enums\ActivityType;
use Tempcord\Discord\Mapping\ArrayMapping;

class Activity
{
    public string $name;
    public ActivityType $type;
    public ?string $url = null;
    public Carbon $created_at;
    public ?ActivityTimestamps $timestamps = null;
    public ?string $application_id = null;
    public ?string $details = null;
    public ?string $state = null;
    public ?ActivityEmoji $emoji = null;
    public ?ActivityParty $party = null;
    public ?ActivityAssets $assets = null;
    public ?ActivitySecrets $secrets = null;
    public bool $instance;
    public ?Bitwise $flags = null;
    /**
     * @var ActivityButton[]
     */
    #[ArrayMapping(ActivityButton::class)]
    public ?array $buttons = null;
}
