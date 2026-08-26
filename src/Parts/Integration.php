<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use Carbon\Carbon;
use CyberWolf\Discord\Enums\IntegrationExpireBehavior;
use CyberWolf\Discord\Enums\Scope;
use CyberWolf\Discord\Mapping\ArrayMapping;

class Integration
{
    public string $id;
    public string $name;
    public string $type;
    public bool $enabled;
    public ?bool $syncing;
    public ?string $role_id;
    public ?bool $enable_emoticons;
    public ?IntegrationExpireBehavior $expire_behavior;
    public ?int $expire_grace_period;
    public ?User $user;
    public Account $account;
    public ?Carbon $synced_at;
    public ?int $subscriber_count;
    public ?bool $revoked;
    public ?Application $application;
    /**
     * @var Scope[]
     */
    #[ArrayMapping(Scope::class)]
    public ?array $scopes;
}
