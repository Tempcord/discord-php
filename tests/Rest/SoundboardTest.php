<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest;

use CyberWolf\Discord\Parts\GuildSoundboardSounds;
use CyberWolf\Discord\Parts\SoundboardSound;
use CyberWolf\Discord\Rest\Helpers\Soundboard\CreateSoundboardSoundBuilder;
use CyberWolf\Discord\Rest\Helpers\Soundboard\ModifySoundboardSoundBuilder;
use CyberWolf\Discord\Rest\Soundboard;
use Tests\CyberWolf\Discord\Rest\HttpHelperTestCase;

class SoundboardTest extends HttpHelperTestCase
{
    protected string $httpItemClass = Soundboard::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'Send soundboard sound' => [
                'method' => 'sendSoundboardSound',
                'args' => ['::channel id::', '::sound id::'],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            'List default sounds' => [
                'method' => 'listDefaultSounds',
                'args' => [],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) []],
                ],
                'validationOptions' => [
                    'returnType' => SoundboardSound::class,
                    'array' => true,
                ],
            ],
            'List guild sounds' => [
                'method' => 'listGuildSounds',
                'args' => ['::guild id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) ['items' => []],
                ],
                'validationOptions' => [
                    'returnType' => GuildSoundboardSounds::class,
                ],
            ],
            'Get guild sound' => [
                'method' => 'getGuildSound',
                'args' => ['::guild id::', '::sound id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => SoundboardSound::class,
                ],
            ],
            'Create guild sound' => [
                'method' => 'createGuildSound',
                'args' => ['::guild id::', CreateSoundboardSoundBuilder::new()],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => SoundboardSound::class,
                ],
            ],
            'Modify guild sound' => [
                'method' => 'modifyGuildSound',
                'args' => ['::guild id::', '::sound id::', ModifySoundboardSoundBuilder::new()],
                'mockOptions' => [
                    'method' => 'patch',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => SoundboardSound::class,
                ],
            ],
            'Delete guild sound' => [
                'method' => 'deleteGuildSound',
                'args' => ['::guild id::', '::sound id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
        ];
    }
}
