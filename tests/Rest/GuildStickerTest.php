<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest;

use Tempcord\Discord\Parts\Sticker;
use Tempcord\Discord\Rest\GuildSticker;
use Tempcord\Discord\Rest\Helpers\GuildSticker\ModifyStickerBuilder;
use Tempcord\Discord\Rest\Helpers\GuildSticker\StickerBuilder;
use Tests\Tempcord\Discord\Rest\HttpHelperTestCase;

class GuildStickerTest extends HttpHelperTestCase
{
    protected string $httpItemClass = GuildSticker::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'List stickers' => [
                'method' => 'list',
                'args' => ['::guild id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) [], (object) [], (object) []],
                ],
                'validationOptions' => [
                    'returnType' => Sticker::class,
                    'array' => true,
                ]
            ],
            'Get sticker' => [
                'method' => 'get',
                'args' => ['::guild id::', '::sticker id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => Sticker::class,
                    'array' => true,
                ]
            ],
            'Create sticker' => [
                'method' => 'create',
                'args' => [
                    '::guild id::',
                    (new StickerBuilder())->setFile('spooky binary data', 'png')
                ],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => Sticker::class,
                    'array' => true,
                ]
            ],
            'Modify sticker' => [
                'method' => 'modify',
                'args' => ['::guild id::', '::sticker id::', new ModifyStickerBuilder()],
                'mockOptions' => [
                    'method' => 'patch',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => Sticker::class,
                    'array' => true,
                ]
            ],
            'Delete sticker' => [
                'method' => 'delete',
                'args' => ['::guild id::', '::sticker id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => []
            ],
        ];
    }
}
