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
    public ?string $url;
    public Carbon $created_at;
    public ?ActivityTimestamps $timestamps;
    public ?string $application_id;
    public ?string $details;
    public ?string $state;
    public ?ActivityEmoji $emoji;
    public ?ActivityParty $party;
    public ?ActivityAssets $assets;
    public ?ActivitySecrets $secrets;
    public bool $instance;
    public ?Bitwise $flags;
    /**
     * @var ActivityButton[]
     */
    #[ArrayMapping(ActivityButton::class)]
    public ?array $buttons;
}
