<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;
use Tempcord\Discord\Enums\SubscriptionStatus;

/**
 * @see https://discord.com/developers/docs/resources/subscription#subscription-object
 */
class Subscription
{
    public string $id;
    public string $user_id;
    /** @var string[] */
    public array $sku_ids;
    /** @var string[] */
    public array $entitlement_ids;
    /** @var ?string[] */
    public ?array $renewal_sku_ids = null;
    public Carbon $current_period_start;
    public Carbon $current_period_end;
    public SubscriptionStatus $status;
    public ?Carbon $canceled_at = null;
    public ?string $country = null;
}
