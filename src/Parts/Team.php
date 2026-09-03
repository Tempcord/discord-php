<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Mapping\ArrayMapping;

class Team
{
    public ?string $icon = null;
    public string $id;
    /**
     * @var TeamMember[]
     */
    #[ArrayMapping(TeamMember::class)]
    public array $members;
    public string $name;
    public string $owner_user_id;
}
