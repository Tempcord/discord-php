<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel\Channel;

use CyberWolf\Discord\Enums\ChannelType;
use CyberWolf\Discord\Enums\VideoQualityMode;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetBitrate;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetNsfw;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetParentId;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetRtcRegion;

/**
 * @see https://discord.com/developers/docs/resources/channel#modify-channel
 */
class GuildVoiceChannelBuilder extends ChannelBuilder
{
    use SetNsfw;
    use SetBitrate;
    use SetParentId;
    use SetRtcRegion;

    public function __construct()
    {
        $this->setChannelType(ChannelType::GUILD_VOICE);
    }

    public function setUserLimit(int $limit): self
    {
        $this->data['user_limit'] = min(max($limit, 0), 100);

        return $this;
    }

    public function setVideoQualityMode(VideoQualityMode $quality): void
    {
        $this->data['video_quality_mode'] = $quality->value;
    }
}
