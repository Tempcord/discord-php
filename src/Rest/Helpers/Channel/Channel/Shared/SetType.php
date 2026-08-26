<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared;

use CyberWolf\Discord\Enums\ChannelType;
use CyberWolf\Discord\Exceptions\Rest\Helpers\Channel\Channel\Shared\SetType\UnsupportedConversionException;

trait SetType
{
    /**
     * Only supports ChannelType::GUILD_TEXT & ChannelType::GUILD_ANNOUNCEMENT
     *
     * @throws UnsupportedConversionException
     */
    public function setType(ChannelType $type): self
    {
        if (!in_array($type, [ChannelType::GUILD_TEXT, ChannelType::GUILD_ANNOUNCEMENT])) {
            throw new UnsupportedConversionException();
        }

        $this->data['type'] = $type->value;

        return $this;
    }

    public function getType(): ?ChannelType
    {
        return isset($this->data['type'])
            ? ChannelType::from($this->data['type'])
            : null;
    }
}
