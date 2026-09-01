<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers\Channel\Channel;

use Tempcord\Discord\Enums\ChannelType;
use Tempcord\Discord\Rest\Helpers\Channel\Channel\Shared\SetDefaultAutoArchiveDuration;
use Tempcord\Discord\Rest\Helpers\Channel\Channel\Shared\SetDefaultThreadRateLimitPerUser;
use Tempcord\Discord\Rest\Helpers\Channel\Channel\Shared\SetNsfw;
use Tempcord\Discord\Rest\Helpers\Channel\Channel\Shared\SetParentId;
use Tempcord\Discord\Rest\Helpers\Channel\Channel\Shared\SetRateLimitPerUser;
use Tempcord\Discord\Rest\Helpers\Channel\Channel\Shared\SetTopic;
use Tempcord\Discord\Rest\Helpers\Channel\Channel\Shared\SetType;

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
