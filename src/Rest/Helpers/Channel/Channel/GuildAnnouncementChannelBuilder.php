<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel\Channel;

use CyberWolf\Discord\Enums\ChannelType;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetDefaultAutoArchiveDuration;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetNsfw;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetParentId;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetTopic;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetType;

/**
 * @see https://discord.com/developers/docs/resources/channel#modify-channel
 */
class GuildAnnouncementChannelBuilder extends ChannelBuilder
{
    use SetType;
    use SetTopic;
    use SetNsfw;
    use SetParentId;
    use SetDefaultAutoArchiveDuration;

    public function __construct()
    {
        $this->setChannelType(ChannelType::GUILD_ANNOUNCEMENT);
    }
}
