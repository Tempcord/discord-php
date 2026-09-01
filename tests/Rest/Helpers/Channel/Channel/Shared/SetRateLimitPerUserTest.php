<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest\Helpers\Channel\Channel\Shared;

use Tempcord\Discord\Constants\Validation\RateLimit;
use Tempcord\Discord\Rest\Helpers\Channel\Channel\Shared\SetRateLimitPerUser;
use PHPUnit\Framework\TestCase;

class SetRateLimitPerUserTest extends TestCase
{
    private function getTestClass(): DummyTraitTester
    {
        return new class () extends DummyTraitTester {
            use SetRateLimitPerUser;
        };
    }

    public function testSetNormalRateLimitPerUser(): void
    {
        $class = $this->getTestClass();
        $class->setRateLimitPerUser(RateLimit::MIN + 1);

        $this->assertEquals(['rate_limit_per_user' => RateLimit::MIN + 1], $class->get());
        $this->assertEquals(RateLimit::MIN + 1, $class->getRateLimitPerUser());
    }

    public function testSetBelowZeroRateLimitPerUser(): void
    {
        $class = $this->getTestClass();
        $class->setRateLimitPerUser(RateLimit::MIN - 1);

        $this->assertEquals(['rate_limit_per_user' => RateLimit::MIN], $class->get());
        $this->assertEquals(RateLimit::MIN, $class->getRateLimitPerUser());
    }

    public function testSetAboveMaxRateLimitPerUser(): void
    {
        $class = $this->getTestClass();
        $class->setRateLimitPerUser(RateLimit::MAX + 1);

        $this->assertEquals(['rate_limit_per_user' => RateLimit::MAX], $class->get());
        $this->assertEquals(RateLimit::MAX, $class->getRateLimitPerUser());
    }
}
