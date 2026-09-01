<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest;

use Tempcord\Discord\Parts\Sku as SkuPart;
use Tempcord\Discord\Rest\Sku;
use Tests\Tempcord\Discord\Rest\HttpHelperTestCase;

class SkuTest extends HttpHelperTestCase
{
    protected string $httpItemClass = Sku::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'List SKUs' => [
                'method' => 'listSkus',
                'args' => ['::application id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) []],
                ],
                'validationOptions' => [
                    'returnType' => SkuPart::class,
                    'array' => true,
                ],
            ],
        ];
    }
}
