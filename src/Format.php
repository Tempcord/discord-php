<?php

declare(strict_types=1);

namespace Tempcord\Discord;

use DateTimeInterface;
use Tempcord\Discord\Enums\TimestampStyle;

/**
 * Discord's message markup.
 *
 * Mentions, timestamps and emoji are assembled by hand wherever a message is
 * built, and one assembled slightly wrong renders as literal text rather than
 * failing — a bot shows `<@123>` to its users and nothing says why. The shapes
 * live here so they are spelled correctly once.
 *
 * @see https://discord.com/developers/docs/reference#message-formatting
 */
final class Format
{
    public static function user(string $userId): string
    {
        return '<@' . $userId . '>';
    }

    public static function role(string $roleId): string
    {
        return '<@&' . $roleId . '>';
    }

    public static function channel(string $channelId): string
    {
        return '<#' . $channelId . '>';
    }

    /**
     * A slash command, rendered as a link that fills it in when clicked.
     *
     * The name is the full path as the user types it, so a subcommand is given
     * as "voice room limit".
     */
    public static function command(string $name, string $commandId): string
    {
        return '</' . $name . ':' . $commandId . '>';
    }

    public static function emoji(string $name, string $emojiId, bool $animated = false): string
    {
        return '<' . ($animated ? 'a' : '') . ':' . $name . ':' . $emojiId . '>';
    }

    /**
     * A moment, drawn in each reader's own timezone.
     *
     * A plain integer is a Unix timestamp in seconds, which is what Discord
     * takes; anything else is asked for one.
     */
    public static function timestamp(
        DateTimeInterface|int $moment,
        TimestampStyle $style = TimestampStyle::ShortDateTime,
    ): string {
        $seconds = $moment instanceof DateTimeInterface ? $moment->getTimestamp() : $moment;

        return '<t:' . $seconds . ':' . $style->value . '>';
    }

    public static function code(string $text): string
    {
        return '`' . $text . '`';
    }

    /**
     * @param string|null $language a syntax highlighting hint, such as "php"
     */
    public static function codeBlock(string $text, ?string $language = null): string
    {
        return '```' . ($language ?? '') . "\n" . $text . "\n" . '```';
    }
}
