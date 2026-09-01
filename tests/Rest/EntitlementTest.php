<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest;

use Tempcord\Discord\Enums\EntitlementOwnerType;
use Tempcord\Discord\Parts\Entitlement as EntitlementPart;
use Tempcord\Discord\Rest\Entitlement;
use Tempcord\Discord\Rest\Helpers\Entitlement\GetEntitlementsBuilder;
use Tests\Tempcord\Discord\Rest\HttpHelperTestCase;

class EntitlementTest extends HttpHelperTestCase
{
    protected string $httpItemClass = Entitlement::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'List entitlements' => [
                'method' => 'listEntitlements',
                'args' => ['::application id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) []],
                ],
                'validationOptions' => [
                    'returnType' => EntitlementPart::class,
                    'array' => true,
                ],
            ],
            'List entitlements with filters' => [
                'method' => 'listEntitlements',
                'args' => [
                    '::application id::',
                    GetEntitlementsBuilder::new()
                        ->setUserId('::user id::')
                        ->setSkuIds(['::sku a::', '::sku b::'])
                        ->setExcludeEnded(true)
                        ->setLimit(50),
                ],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) []],
                ],
                'validationOptions' => [
                    'returnType' => EntitlementPart::class,
                    'array' => true,
                ],
            ],
            'Get entitlement' => [
                'method' => 'getEntitlement',
                'args' => ['::application id::', '::entitlement id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => EntitlementPart::class,
                ],
            ],
            'Consume entitlement' => [
                'method' => 'consumeEntitlement',
                'args' => ['::application id::', '::entitlement id::'],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            'Create test entitlement' => [
                'method' => 'createTestEntitlement',
                'args' => [
                    '::application id::',
                    '::sku id::',
                    '::guild id::',
                    EntitlementOwnerType::GUILD_SUBSCRIPTION,
                ],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => EntitlementPart::class,
                ],
            ],
            'Delete test entitlement' => [
                'method' => 'deleteTestEntitlement',
                'args' => ['::application id::', '::entitlement id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
        ];
    }
}
