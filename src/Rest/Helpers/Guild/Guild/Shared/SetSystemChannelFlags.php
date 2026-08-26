<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Guild\Guild\Shared;

use CyberWolf\Discord\Bitwise\Bitwise;

trait SetSystemChannelFlags
{
    /**
     * @param Bitwise<\CyberWolf\Discord\Enums\SystemChannelFlag> $flags
     */
    public function setSystemChannelFlags(Bitwise $flags): static
    {
        $this->data['system_channel_flags'] = $flags->get();

        return $this;
    }

    public function getSystemChannelFlags(): ?Bitwise
    {
        return isset($this->data['system_channel_flags'])
            ? new Bitwise($this->data['system_channel_flags'])
            : null;
    }
}
