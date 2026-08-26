<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest;

use CyberWolf\Discord\Parts\StickerPack;
use CyberWolf\Discord\Parts\Sticker as PartsSticker;
use CyberWolf\Discord\Rest\Sticker;
use Tests\CyberWolf\Discord\Rest\HttpHelperTestCase;

class StickerTest extends HttpHelperTestCase
{
    protected string $httpItemClass = Sticker::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'Get sticker' => [
                'method' => 'get',
                'args' => ['::sticker id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => PartsSticker::class,
                ]
            ],
            'List nitro packs' => [
                'method' => 'listNitroPacks',
                'args' => [],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) [], (object) [], (object) []],
                ],
                'validationOptions' => [
                    'returnType' => StickerPack::class,
                    'array' => true,
                ]
            ],
        ];
    }
}
