<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Component;

use PHPUnit\Framework\TestCase;
use CyberWolf\Discord\Component\Button\DangerButton;
use CyberWolf\Discord\Component\Button\LinkButton;
use CyberWolf\Discord\Component\Button\PremiumButton;
use CyberWolf\Discord\Component\Button\PrimaryButton;
use CyberWolf\Discord\Component\Button\SecondaryButton;
use CyberWolf\Discord\Component\Button\SuccessButton;
use CyberWolf\Discord\Enums\ButtonStyle;
use CyberWolf\Discord\Parts\Emoji;
use CyberWolf\Discord\Rest\Helpers\Emoji\EmojiBuilder;

class ButtonTest extends TestCase
{
    private static function getEmoji(): EmojiBuilder
    {
        $emoji = new Emoji();
        $emoji->id = '::emoji id::';
        $emoji->name = '::emoji name::';
        $emoji->animated = true;

        return EmojiBuilder::fromPart($emoji);
    }

    /**
     * @dataProvider convertionExpectationProvider
     */
    public function testCorrectlyConverted(array $args, array $expected): void
    {
        $buttonTypes = [
            DangerButton::class => ButtonStyle::Danger->value,
            PrimaryButton::class => ButtonStyle::Primary->value,
            SecondaryButton::class => ButtonStyle::Secondary->value,
            SuccessButton::class => ButtonStyle::Success->value,
        ];

        foreach ($buttonTypes as $buttonClass => $buttonStyle) {
            $expected['style'] = $buttonStyle;

            $button = new $buttonClass(...$args);

            $this->assertEquals($expected, $button->get());
        }
    }

    public static function convertionExpectationProvider(): array
    {
        return [
            'Completely filled out' => [
                'args' => [
                    '::custom id::',
                    '::label::',
                    self::getEmoji(),
                    true,
                ],
                'expected' => [
                    'type' => 2,
                    'custom_id' => '::custom id::',
                    'label' => '::label::',
                    'emoji' => self::getEmoji()->get(),
                    'disabled' => true
                ],
            ],
            'Missing label' => [
                'args' => [
                    '::custom id::',
                    null,
                    self::getEmoji(),
                    true,
                ],
                'expected' => [
                    'type' => 2,
                    'custom_id' => '::custom id::',
                    'emoji' => self::getEmoji()->get(),
                    'disabled' => true
                ],
            ],
            'Missing emoji' => [
                'args' => [
                    '::custom id::',
                    '::label::',
                    null,
                    true,
                ],
                'expected' => [
                    'type' => 2,
                    'custom_id' => '::custom id::',
                    'label' => '::label::',
                    'disabled' => true
                ],
            ],
            'Missing disabled' => [
                'args' => [
                    '::custom id::',
                    '::label::',
                    self::getEmoji(),
                ],
                'expected' => [
                    'type' => 2,
                    'custom_id' => '::custom id::',
                    'label' => '::label::',
                    'emoji' => self::getEmoji()->get(),
                    'disabled' => false
                ],
            ],
        ];
    }

    /**
     * @dataProvider convertionExpectationProviderLinkButton
     */
    public function testCorrectlyConvertedLinkButton(array $args, array $expected): void
    {
        $button = new LinkButton(...$args);

        $this->assertEquals($expected, $button->get());
    }

    public static function convertionExpectationProviderLinkButton(): array
    {
        return [
            'Completely filled out' => [
                'args' => [
                    '::url::',
                    '::label::',
                    self::getEmoji(),
                    true,
                ],
                'expected' => [
                    'type' => 2,
                    'style' => ButtonStyle::Link,
                    'url' => '::url::',
                    'label' => '::label::',
                    'emoji' => self::getEmoji()->get(),
                    'disabled' => true
                ],
            ],
            'Missing label' => [
                'args' => [
                    '::url::',
                    null,
                    self::getEmoji(),
                    true,
                ],
                'expected' => [
                    'type' => 2,
                    'style' => ButtonStyle::Link,
                    'url' => '::url::',
                    'emoji' => self::getEmoji()->get(),
                    'disabled' => true
                ],
            ],
            'Missing emoji' => [
                'args' => [
                    '::url::',
                    '::label::',
                    null,
                    true,
                ],
                'expected' => [
                    'type' => 2,
                    'style' => ButtonStyle::Link,
                    'url' => '::url::',
                    'label' => '::label::',
                    'disabled' => true
                ],
            ],
            'Missing disabled' => [
                'args' => [
                    '::url::',
                    '::label::',
                    self::getEmoji(),
                ],
                'expected' => [
                    'type' => 2,
                    'style' => ButtonStyle::Link,
                    'url' => '::url::',
                    'label' => '::label::',
                    'emoji' => self::getEmoji()->get(),
                    'disabled' => false
                ],
            ],
        ];
    }

    /**
     * @dataProvider convertionExpectationProviderPremiumButton
     */
    public function testCorrectlyConvertedPremiumButton(array $args, array $expected): void
    {
        $button = new PremiumButton(...$args);

        $this->assertEquals($expected, $button->get());
    }

    public static function convertionExpectationProviderPremiumButton(): array
    {
        return [
            'Completely filled out' => [
                'args' => [
                    '::sku::',
                    true,
                ],
                'expected' => [
                    'type' => 2,
                    'style' => ButtonStyle::Premium,
                    'sku_id' => '::sku::',
                    'disabled' => true
                ],
            ],
            'Missing disabled' => [
                'args' => [
                    '::sku::',
                ],
                'expected' => [
                    'type' => 2,
                    'style' => ButtonStyle::Premium,
                    'sku_id' => '::sku::',
                    'disabled' => false
                ],
            ],
        ];
    }
}
