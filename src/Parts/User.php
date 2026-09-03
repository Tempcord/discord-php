<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Tempcord\Discord\Attributes\Partial;
use Tempcord\Discord\Bitwise\Bitwise;
use Tempcord\Discord\Enums\PremiumTier;

class User
{
    public string $id;
    public string $username;
    public ?string $global_name = null;
    public string $discriminator;
    public ?string $avatar = null;
    public ?bool $bot = null;
    public ?bool $system = null;
    public ?bool $mfa_enabled = null;
    public ?string $banner = null;
    public ?int $accent_color = null;
    public ?string $locale = null;
    public bool $verified;
    public ?string $email = null;
    public ?Bitwise $flags = null;
    public ?PremiumTier $premium_type = null;
    public ?Bitwise $public_flags = null;
    public ?GuildMember $member = null;
}
