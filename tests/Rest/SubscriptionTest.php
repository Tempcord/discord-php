<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest;

use Discord\Http\Endpoint;
use Tempcord\Discord\Parts\Subscription as SubscriptionPart;
use Tempcord\Discord\Rest\Helpers\Subscription\GetSubscriptionsBuilder;
use Tempcord\Discord\Rest\Subscription;
use Tests\Tempcord\Discord\Rest\HttpHelperTestCase;

class SubscriptionTest extends HttpHelperTestCase
{
    protected string $httpItemClass = Subscription::class;

    /**
     * The endpoint constant upstream carries a leading slash that the request
     * builder would turn into a doubled separator.
     */
    public function testTheSubscriptionPathHasNoLeadingSlash(): void
    {
        $this->assertSame(
            'skus/::sku id::/subscriptions',
            (string) Endpoint::bind(ltrim(Endpoint::SKU_SUBSCRIPTIONS, '/'), '::sku id::')
        );
    }

    public static function httpBindingsProvider(): array
    {
        return [
            'List SKU subscriptions' => [
                'method' => 'listSkuSubscriptions',
                'args' => ['::sku id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) []],
                ],
                'validationOptions' => [
                    'returnType' => SubscriptionPart::class,
                    'array' => true,
                ],
            ],
            'List SKU subscriptions with filters' => [
                'method' => 'listSkuSubscriptions',
                'args' => [
                    '::sku id::',
                    GetSubscriptionsBuilder::new()->setUserId('::user id::')->setLimit(100),
                ],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) []],
                ],
                'validationOptions' => [
                    'returnType' => SubscriptionPart::class,
                    'array' => true,
                ],
            ],
            'Get SKU subscription' => [
                'method' => 'getSkuSubscription',
                'args' => ['::sku id::', '::subscription id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => SubscriptionPart::class,
                ],
            ],
        ];
    }
}
