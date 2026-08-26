<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared;

use PHPUnit\Framework\TestCase;
use CyberWolf\Discord\Enums\ChannelType;
use CyberWolf\Discord\Exceptions\Rest\Helpers\Channel\Channel\Shared\SetType\UnsupportedConversionException;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetType;

class SetTypeTest extends TestCase
{
    private function getClass(): DummyTraitTester
    {
        return new class () extends DummyTraitTester {
            use SetType;
        };
    }

    public function testSetType(): void
    {
        $class = $this->getClass();
        $class->setType(ChannelType::GUILD_TEXT);
        $this->assertEquals(['type' => ChannelType::GUILD_TEXT->value], $class->get());
        $this->assertEquals(ChannelType::GUILD_TEXT, $class->getType());
    }

    public function testSetTypeUnsupportedConversionException(): void
    {
        $class = $this->getClass();
        $this->expectException(
            UnsupportedConversionException::class
        );
        $class->setType(ChannelType::GUILD_VOICE);
    }
}
