<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Bitwise\Bitwise;
use Tempcord\Discord\Mapping\ArrayMapping;

class Application
{
    public string $id;
    public string $name;
    public ?string $icon = null;
    public string $description;
    /**
     * @var string[]
     */
    public ?array $rpc_origins = null;
    public bool $bot_public;
    public bool $bot_require_code_grant;
    public ?string $terms_of_service_url = null;
    public ?string $privacy_policy_url = null;
    public ?User $owner = null;
    public string $verify_key;
    public ?Team $team = null;
    public ?string $guild_id = null;
    public ?string $primary_sku_id = null;
    public ?string $slug = null;
    public ?string $cover_image = null;
    public ?Bitwise $flags = null;
    public ?int $approximate_guild_count = null;
    public ?int $approximate_user_install_count = null;
    /**
     * @var string[]
     */
    public ?array $redirect_uris = null;
    public ?string $interactions_endpoint_url = null;
    /**
     * @var string[]
     */
    public ?array $tags = null;
    public ?InstallParams $install_params = null;
    public ?string $custom_install_url = null;
    public ?string $role_connections_verification_url = null;
    /**
     * @var ApplicationIntegrationType[]
     */
    #[ArrayMapping(ApplicationIntegrationType::class)]
    public ?array $integration_types_config = null;
}
