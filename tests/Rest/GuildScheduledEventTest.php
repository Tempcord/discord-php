<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest;

use Tempcord\Discord\Parts\GuildScheduledEvent;
use Tempcord\Discord\Parts\GuildScheduledEventUser;
use Tempcord\Discord\Rest\GuildScheduledEvent as RestGuildScheduledEvent;

class GuildScheduledEventTest extends HttpHelperTestCase
{
    protected string $httpItemClass = RestGuildScheduledEvent::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'List scheduled events' => [
                'method' => 'list',
                'args' => ['::guild id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) [], (object) []],
                ],
                'validationOptions' => [
                    'returnType' => GuildScheduledEvent::class,
                    'array' => true,
                    'url' => 'guilds/::guild id::/scheduled-events?with_user_count=0',
                ]
            ],
            /*
             * These three answer with one event, not a list of them. Mapping
             * the answer as an array handed a stdClass to a parameter declared
             * array, so every call died on a TypeError before it could return.
             */
            'Get scheduled event' => [
                'method' => 'get',
                'args' => ['::guild id::', '::event id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) ['id' => '::event id::'],
                ],
                'validationOptions' => [
                    'returnType' => GuildScheduledEvent::class,
                ]
            ],
            'Create scheduled event' => [
                'method' => 'create',
                'args' => ['::guild id::', ['name' => '::name::']],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => (object) ['id' => '::event id::'],
                ],
                'validationOptions' => [
                    'returnType' => GuildScheduledEvent::class,
                ]
            ],
            'Modify scheduled event' => [
                'method' => 'modify',
                'args' => ['::guild id::', '::event id::', ['name' => '::name::']],
                'mockOptions' => [
                    'method' => 'patch',
                    'return' => (object) ['id' => '::event id::'],
                ],
                'validationOptions' => [
                    'returnType' => GuildScheduledEvent::class,
                ]
            ],
            'Delete scheduled event' => [
                'method' => 'delete',
                'args' => ['::guild id::', '::event id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => []
            ],
            'Get scheduled event users' => [
                'method' => 'getUsers',
                'args' => ['::guild id::', '::event id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) [], (object) []],
                ],
                'validationOptions' => [
                    'returnType' => GuildScheduledEventUser::class,
                    'array' => true,
                ]
            ],
        ];
    }
}
