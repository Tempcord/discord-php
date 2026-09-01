<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest;

use Tempcord\Discord\Parts\Channel;
use Tempcord\Discord\Parts\Guild as PartsGuild;
use Tempcord\Discord\Parts\GuildBan;
use Tempcord\Discord\Parts\GuildMember;
use Tempcord\Discord\Parts\GuildPreview;
use Tempcord\Discord\Parts\WelcomeScreen;
use Tempcord\Discord\Parts\BulkBanResult;
use Tempcord\Discord\Parts\GuildOnboarding;
use Tempcord\Discord\Rest\Helpers\Guild\ModifyGuildOnboardingBuilder;
use Tempcord\Discord\Rest\Helpers\Guild\ModifyWelcomeScreenBuilder;
use Tempcord\Discord\Rest\Guild;
use Tempcord\Discord\Rest\Helpers\Guild\ModifyChannelPositionsBuilder;
use Tests\Tempcord\Discord\Rest\HttpHelperTestCase;

class GuildTest extends HttpHelperTestCase
{
    protected string $httpItemClass = Guild::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'Modify welcome screen' => [
                'method' => 'modifyWelcomeScreen',
                'args' => ['::guild id::', ModifyWelcomeScreenBuilder::new()],
                'mockOptions' => [
                    'method' => 'patch',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => WelcomeScreen::class,
                ],
            ],
            'Get onboarding' => [
                'method' => 'getOnboarding',
                'args' => ['::guild id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => GuildOnboarding::class,
                ],
            ],
            'Modify onboarding' => [
                'method' => 'modifyOnboarding',
                'args' => ['::guild id::', ModifyGuildOnboardingBuilder::new()],
                'mockOptions' => [
                    'method' => 'put',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => GuildOnboarding::class,
                ],
            ],
            /*
             * Discord answers a channel creation with the new channel object,
             * not with a list of one. Mapping it as a list threw before it
             * could return, and there was no test to catch it.
             */
            'Create channel' => [
                'method' => 'createChannel',
                'args' => ['::guild id::', ['name' => '::channel name::', 'type' => 0]],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => (object) ['id' => '::channel id::', 'name' => '::channel name::'],
                ],
                'validationOptions' => [
                    'returnType' => Channel::class,
                ],
            ],
            'Bulk ban' => [
                'method' => 'bulkBan',
                'args' => ['::guild id::', ['::user a::', '::user b::'], 3600],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => BulkBanResult::class,
                ],
            ],
            'Get role member counts' => [
                'method' => 'getRoleMemberCounts',
                'args' => ['::guild id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [],
            ],
            'Get guild' => [
                'method' => 'get',
                'args' => ['::guild id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => PartsGuild::class,
                ]
            ],
            'Get guild with counts' => [
                'method' => 'get',
                'args' => ['::guild id::', true],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => PartsGuild::class,
                ]
            ],
            'Get preview' => [
                'method' => 'getPreview',
                'args' => ['::guild id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => GuildPreview::class,
                ]
            ],
            'Delete guild' => [
                'method' => 'delete',
                'args' => ['::guild id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => [
                ]
            ],
            'Get channels' => [
                'method' => 'getChannels',
                'args' => ['::guild id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) [], (object) [], (object) []],
                ],
                'validationOptions' => [
                    'returnType' => Channel::class,
                    'array' => true,
                ]
            ],
            'Modify channel position' => [
                'method' => 'modifyChannelPositions',
                'args' => [
                    '::guild id::',
                    [
                        ModifyChannelPositionsBuilder::new(),
                        ModifyChannelPositionsBuilder::new(),
                    ]
                ],
                'mockOptions' => [
                    'method' => 'patch',
                    'return' => null,
                ],
                'validationOptions' => [
                ]
            ],
            'Get member' => [
                'method' => 'getMember',
                'args' => ['::guild id::', '::member id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => GuildMember::class,
                ]
            ],
            'Add member role' => [
                'method' => 'addMemberRole',
                'args' => ['::guild id::', '::member id::', '::role id::'],
                'mockOptions' => [
                    'method' => 'put',
                    'return' => null,
                ],
                'validationOptions' => []
            ],
            'Remove member role' => [
                'method' => 'removeMemberRole',
                'args' => ['::guild id::', '::member id::', '::role id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => []
            ],
            'Get ban' => [
                'method' => 'getBan',
                'args' => ['::guild id::', '::member id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => GuildBan::class,
                ]
            ],
        ];
    }
}
