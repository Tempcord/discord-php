<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

use CyberWolf\Discord\Attributes\Partial;
use CyberWolf\Discord\Bitwise\Bitwise;
use CyberWolf\Discord\Enums\PremiumTier;

class User
{
    public string $id;
    public string $username;
    public ?string $global_name;
    public string $discriminator;
    public ?string $avatar;
    public ?bool $bot;
    public ?bool $system;
    public ?bool $mfa_enabled;
    public ?string $banner;
    public ?int $accent_color;
    public ?string $locale;
    public bool $verified;
    public ?string $email;
    public ?Bitwise $flags;
    public ?PremiumTier $premium_type;
    public ?Bitwise $public_flags;
    public ?GuildMember $member;
}
