<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest\Helpers\Emoji;

use Tempcord\Discord\Parts\Emoji;
use Tempcord\Discord\Rest\Helpers\Emoji\EmojiBuilder;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class EmojiBuilderTest extends TestCase
{
    public function testSetName(): void
    {
        $emojiBuilder = new EmojiBuilder();
        $emojiBuilder->setName('::name::');
        $this->assertEquals(['name' => '::name::'], $emojiBuilder->get());
        $this->assertEquals('::name::', $emojiBuilder->getName());
    }

    public function testSetId(): void
    {
        $emojiBuilder = new EmojiBuilder();
        $emojiBuilder->setId('::id::');
        $this->assertEquals(['id' => '::id::'], $emojiBuilder->get());
        $this->assertEquals('::id::', $emojiBuilder->getId());
    }

    public function testSetAnimated(): void
    {
        $emojiBuilder = new EmojiBuilder();
        $emojiBuilder->setAnimated(true);
        $this->assertEquals(['animated' => true], $emojiBuilder->get());
        $this->assertTrue($emojiBuilder->getAnimated());
    }

    public function testCreateEmojiFromId(): void
    {
        $emojiBuilder = new EmojiBuilder();
        $stringEmoji = '✅';
        $emojiBuilder->setId($stringEmoji);

        $this->assertEquals(urlencode($stringEmoji), (string) $emojiBuilder);
    }

    public function testCreateEmojiFromIdAndName(): void
    {
        $emojiBuilder = new EmojiBuilder();
        $emojiBuilder->setName('name');
        $emojiBuilder->setId('12345');

        $this->assertEquals('name:12345', (string) $emojiBuilder);
    }

    /**
     * A reaction event carries a standard emoji as its name with no id, which
     * is what fromPart() copies across. Rendering that as "✅:" — with the id
     * missing entirely — made every reaction on a standard emoji a malformed
     * request, and warned about an undefined key on the way out.
     */
    public function testCreateEmojiFromNameAlone(): void
    {
        $emojiBuilder = new EmojiBuilder();
        $emojiBuilder->setName('✅');

        $this->assertEquals(rawurlencode('✅'), (string) $emojiBuilder);
    }

    public function testAStandardEmojiFromAReactionEventIsRenderedForTheEndpoint(): void
    {
        $emoji = new Emoji();
        $emoji->name = '❌';
        $emoji->id = null;

        $this->assertEquals(rawurlencode('❌'), (string) EmojiBuilder::fromPart($emoji));
    }

    public function testACustomEmojiFromAReactionEventKeepsBothHalves(): void
    {
        $emoji = new Emoji();
        $emoji->name = 'apex';
        $emoji->id = '12345';

        $this->assertEquals('apex:12345', (string) EmojiBuilder::fromPart($emoji));
    }

    #[DataProvider('getFromPartProvider')]
    public function testGetFromPart(Emoji $emoji, array $result): void
    {
        $this->assertEquals(EmojiBuilder::fromPart($emoji)->get(), $result);
    }

    public static function getFromPartProvider(): array
    {
        return [
            'All properties' => [
                'emoji' => (static function () {
                    $emoji = new Emoji();

                    $emoji->id = '::id::';
                    $emoji->name = '::name::';
                    $emoji->animated = true;

                    return $emoji;
                })(),
                'result' => [
                    'id' => '::id::',
                    'name' => '::name::',
                    'animated' => true,
                ],
            ],
            'No properties' => [
                'emoji' => (static fn () => new Emoji())(),
                'result' => [],
            ],
        ];
    }
}
