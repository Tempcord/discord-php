<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Mapping\ArrayMapping;

class Team
{
    public ?string $icon;
    public string $id;
    /**
     * @var TeamMember[]
     */
    #[ArrayMapping(TeamMember::class)]
    public array $members;
    public string $name;
    public string $owner_user_id;
}
