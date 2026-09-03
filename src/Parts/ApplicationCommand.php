<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Enums\ApplicationCommandTypes;
use Tempcord\Discord\Enums\ApplicationIntegrationType;
use Tempcord\Discord\Enums\InteractionContextType;
use Tempcord\Discord\Mapping\ArrayMapping;

class ApplicationCommand
{
    public string $id;
    public ?ApplicationCommandTypes $type = null;
    public string $application_id;
    public ?string $guild_id = null;
    public string $name;
    /**
     * @var array<string, string>
     */
    public ?array $name_localizations = null;
    public string $description;
    /**
     * @var array<string, string>
     */
    public ?array $description_localizations = null;
    /**
     * @var ApplicationCommandOptionStructure[]
     */
    #[ArrayMapping(ApplicationCommandOptionStructure::class)]
    public ?array $options = null;
    public ?string $default_member_permissions = null;
    /**
     * @deprecated use $this->contexts instead
     */
    public ?bool $dm_permission = null;
    public ?bool $default_permission = null;
    public ?bool $nsfw = null;
    public string $version;
    /**
     * @var ApplicationIntegrationType[]
     */
    #[ArrayMapping(ApplicationIntegrationType::class)]
    public ?array $integration_types = null;
    /**
     * @var InteractionContextType[]
     */
    #[ArrayMapping(InteractionContextType::class)]
    public ?array $contexts = null;
}
