<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;
use Tempcord\Discord\Enums\EntitlementType;

/**
 * @see https://discord.com/developers/docs/resources/entitlement#entitlement-object
 */
class Entitlement
{
    public string $id;
    public string $sku_id;
    public string $application_id;
    public ?string $user_id = null;
    public EntitlementType $type;
    public bool $deleted;
    public ?Carbon $starts_at = null;
    public ?Carbon $ends_at = null;
    public ?string $guild_id = null;
    public bool $consumed;
}
