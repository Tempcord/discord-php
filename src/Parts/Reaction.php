<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Parts;

class Reaction
{
    public int $count;
    public bool $me;
    public Emoji $emoji;
}
