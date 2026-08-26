<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest;

use CyberWolf\Discord\Parts\Sku as SkuPart;
use CyberWolf\Discord\Rest\Sku;
use Tests\CyberWolf\Discord\Rest\HttpHelperTestCase;

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
