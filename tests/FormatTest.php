<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tempcord\Discord\Enums\TimestampStyle;
use Tempcord\Discord\Format;

class FormatTest extends TestCase
{
    public function testMentionsAUser(): void
    {
        $this->assertSame('<@254766810296090626>', Format::user('254766810296090626'));
    }

    public function testMentionsARole(): void
    {
        $this->assertSame('<@&979052732218503178>', Format::role('979052732218503178'));
    }

    public function testMentionsAChannel(): void
    {
        $this->assertSame('<#979052732218503179>', Format::channel('979052732218503179'));
    }

    /**
     * A subcommand is mentioned by the whole path the user types, not just the
     * leaf, and carries the id of the top level command it belongs to.
     */
    public function testMentionsASubcommandByItsFullPath(): void
    {
        $this->assertSame('</voice room limit:12345>', Format::command('voice room limit', '12345'));
    }

    public function testFormatsACustomEmoji(): void
    {
        $this->assertSame('<:apex:12345>', Format::emoji('apex', '12345'));
    }

    public function testAnAnimatedEmojiIsMarkedAsOne(): void
    {
        $this->assertSame('<a:apex:12345>', Format::emoji('apex', '12345', animated: true));
    }

    public function testATimestampIsTakenAsSeconds(): void
    {
        $this->assertSame('<t:1618928400:f>', Format::timestamp(1618928400));
    }

    public function testATimestampCanBeGivenAsADate(): void
    {
        $this->assertSame(
            '<t:1618928400:f>',
            Format::timestamp(new DateTimeImmutable('@1618928400')),
        );
    }

    /**
     * Discord's own default when a style is left off, so leaving it off here
     * has to mean the same thing.
     */
    public function testTheDefaultStyleIsShortDateTime(): void
    {
        $this->assertSame(
            Format::timestamp(1618928400, TimestampStyle::ShortDateTime),
            Format::timestamp(1618928400),
        );
    }

    #[DataProvider('stylesProvider')]
    public function testATimestampCarriesItsStyle(TimestampStyle $style, string $expected): void
    {
        $this->assertSame($expected, Format::timestamp(1618928400, $style));
    }

    public static function stylesProvider(): array
    {
        return [
            'short time' => [TimestampStyle::ShortTime, '<t:1618928400:t>'],
            'long time' => [TimestampStyle::LongTime, '<t:1618928400:T>'],
            'short date' => [TimestampStyle::ShortDate, '<t:1618928400:d>'],
            'long date' => [TimestampStyle::LongDate, '<t:1618928400:D>'],
            'short date and time' => [TimestampStyle::ShortDateTime, '<t:1618928400:f>'],
            'long date and time' => [TimestampStyle::LongDateTime, '<t:1618928400:F>'],
            'relative' => [TimestampStyle::Relative, '<t:1618928400:R>'],
        ];
    }

    public function testFormatsInlineCode(): void
    {
        $this->assertSame('`/warn`', Format::code('/warn'));
    }

    /**
     * The closing fence has to be on its own line, or a block whose content
     * ends without a newline swallows it.
     */
    public function testFormatsACodeBlock(): void
    {
        $this->assertSame("```\nechoed\n```", Format::codeBlock('echoed'));
    }

    public function testACodeBlockCanNameItsLanguage(): void
    {
        $this->assertSame("```php\n\$x = 1;\n```", Format::codeBlock('$x = 1;', 'php'));
    }
}
