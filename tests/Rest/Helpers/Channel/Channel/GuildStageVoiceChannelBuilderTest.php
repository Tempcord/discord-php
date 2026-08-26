<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest\Helpers\Channel\Channel;

use PHPUnit\Framework\TestCase;
use CyberWolf\Discord\Enums\ChannelType;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\GuildStageVoiceChannelBuilder;

class GuildStageVoiceChannelBuilderTest extends TestCase
{
    public function testConstructorSetsCorrectType(): void
    {
        $channelBuilder = new GuildStageVoiceChannelBuilder();

        $this->assertEquals([
            'type' => ChannelType::GUILD_STAGE_VOICE->value
        ], $channelBuilder->get());
    }
}
