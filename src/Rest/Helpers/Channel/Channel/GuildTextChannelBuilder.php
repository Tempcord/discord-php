<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel\Channel;

use CyberWolf\Discord\Enums\ChannelType;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetDefaultAutoArchiveDuration;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetDefaultThreadRateLimitPerUser;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetNsfw;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetParentId;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetRateLimitPerUser;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetTopic;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetType;

/**
 * @see https://discord.com/developers/docs/resources/channel#modify-channel
 */
class GuildTextChannelBuilder extends ChannelBuilder
{
    use SetType;
    use SetTopic;
    use SetNsfw;
    use SetRateLimitPerUser;
    use SetParentId;
    use SetDefaultAutoArchiveDuration;
    use SetDefaultThreadRateLimitPerUser;

    public function __construct()
    {
        $this->setChannelType(ChannelType::GUILD_TEXT);
    }
}
