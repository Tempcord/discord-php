<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest;

use Tempcord\Discord\Parts\StickerPack;
use Tempcord\Discord\Parts\Sticker as PartsSticker;
use Tempcord\Discord\Rest\Sticker;
use Tests\Tempcord\Discord\Rest\HttpHelperTestCase;

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
