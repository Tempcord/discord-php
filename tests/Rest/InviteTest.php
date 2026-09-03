<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest;

use Tempcord\Discord\Parts\Invite;
use Tempcord\Discord\Rest\Invite as RestInvite;

class InviteTest extends HttpHelperTestCase
{
    protected string $httpItemClass = RestInvite::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'Get invite' => [
                'method' => 'get',
                'args' => ['::code::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => Invite::class,
                ]
            ],
            'Delete invite' => [
                'method' => 'delete',
                'args' => ['::code::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => []
            ],
        ];
    }
}
