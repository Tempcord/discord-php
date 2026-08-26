<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers;

use CyberWolf\Discord\Enums\ImageData;

trait GetBase64Image
{
    public static function getBase64Image(string $content, ImageData $imageData): string
    {
        return 'data:' . $imageData->value . ';base64,' . base64_encode($content);
    }
}
