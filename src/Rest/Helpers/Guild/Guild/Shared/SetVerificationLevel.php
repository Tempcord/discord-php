<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers\Guild\Guild\Shared;

use Tempcord\Discord\Enums\VerificationLevel;

trait SetVerificationLevel
{
    public function setVerificationLevel(VerificationLevel $level): static
    {
        $this->data['verification_level'] = $level->value;

        return $this;
    }

    public function getVerificationLevel(): ?VerificationLevel
    {
        return isset($this->data['verification_level'])
            ? VerificationLevel::from($this->data['verification_level'])
            : null;
    }
}
