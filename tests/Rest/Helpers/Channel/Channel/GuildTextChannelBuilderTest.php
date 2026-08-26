<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest\Helpers\Channel\Channel;

use PHPUnit\Framework\TestCase;
use CyberWolf\Discord\Enums\ChannelType;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\GuildTextChannelBuilder;

class GuildTextChannelBuilderTest extends TestCase
{
    public function testConstructorSetsCorrectType(): void
    {
        $channelBuilder = new GuildTextChannelBuilder();

        $this->assertEquals([
            'type' => ChannelType::GUILD_TEXT->value
        ], $channelBuilder->get());
    }
}
