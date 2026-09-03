<?php

declare(strict_types=1);

namespace Tempcord\Discord\Constants\Validation;

class Command
{
    /**
     * Discord's own rule for a command name.
     *
     * The u modifier is what makes \p{L} mean "a letter" rather than "a byte
     * that happens to be one": without it every name outside ASCII is rejected,
     * because each character of a Cyrillic or Greek name is two bytes and
     * neither of them is a letter on its own.
     */
    public const NAME_REGEX = '/^[-_\p{L}\p{N}\p{sc=Deva}\p{sc=Thai}]{1,32}$/u';
}
