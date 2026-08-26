<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel\Channel;

use CyberWolf\Discord\Enums\ChannelType;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetBitrate;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetRtcRegion;

/**
 * @see https://discord.com/developers/docs/resources/channel#modify-channel
 */
class GuildStageVoiceChannelBuilder extends ChannelBuilder
{
    use SetBitrate;
    use SetRtcRegion;

    public function __construct()
    {
        $this->setChannelType(ChannelType::GUILD_STAGE_VOICE);
    }
}
