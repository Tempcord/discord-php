<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers;

use Tempcord\Discord\Enums\SoundData;

trait GetBase64Sound
{
    public static function getBase64Sound(string $content, SoundData $soundData): string
    {
        return 'data:' . $soundData->value . ';base64,' . base64_encode($content);
    }
}
