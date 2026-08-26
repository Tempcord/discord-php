<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers;

use CyberWolf\Discord\Enums\SoundData;

trait GetBase64Sound
{
    public static function getBase64Sound(string $content, SoundData $soundData): string
    {
        return 'data:' . $soundData->value . ';base64,' . base64_encode($content);
    }
}
