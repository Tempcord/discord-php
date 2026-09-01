<?php

declare(strict_types=1);

namespace Fakes\Tempcord\Discord;

use Tempcord\Discord\Rest\Rest;
use Mockery;
use Mockery\Mock;
use ReflectionClass;

class RestFake
{
    public static function get(): Rest|Mock
    {
        $reflection = new ReflectionClass(Rest::class);

        /**  @var Rest */
        $instance = $reflection->newInstanceWithoutConstructor();

        foreach ($reflection->getProperties() as $property) {
            if (!$property->isPublic()) {
                continue;
            }

            $property->setValue($instance, Mockery::mock($property->getType()->getName()));
        }

        return $instance;
    }
}
