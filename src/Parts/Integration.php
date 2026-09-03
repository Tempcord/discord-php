<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;
use Tempcord\Discord\Enums\IntegrationExpireBehavior;
use Tempcord\Discord\Enums\Scope;
use Tempcord\Discord\Mapping\ArrayMapping;

class Integration
{
    public string $id;
    public string $name;
    public string $type;
    public bool $enabled;
    public ?bool $syncing = null;
    public ?string $role_id = null;
    public ?bool $enable_emoticons = null;
    public ?IntegrationExpireBehavior $expire_behavior = null;
    public ?int $expire_grace_period = null;
    public ?User $user = null;
    public Account $account;
    public ?Carbon $synced_at = null;
    public ?int $subscriber_count = null;
    public ?bool $revoked = null;
    public ?Application $application = null;
    /**
     * @var Scope[]
     */
    #[ArrayMapping(Scope::class)]
    public ?array $scopes = null;
}
