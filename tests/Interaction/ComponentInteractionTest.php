<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Interaction;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tempcord\Discord\DataMapper;
use Tempcord\Discord\Discord;
use Tempcord\Discord\Enums\MessageComponentType;
use Tempcord\Discord\Gateway\Events\InteractionCreate;
use Tempcord\Discord\Interaction\ComponentInteraction;
use Fakes\Tempcord\Discord\DataMapperFake;
use Psr\Log\NullLogger;

class ComponentInteractionTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private function interaction(array $data): ComponentInteraction
    {
        $mapper = new DataMapper(new NullLogger());

        return new ComponentInteraction(
            $mapper->map((object) ['data' => (object) $data], InteractionCreate::class),
            Mockery::mock(Discord::class)
        );
    }

    /**
     * Discord sends the picked values as plain strings; they used to be mapped
     * into option objects, which silently discarded every selection.
     */
    public function testItReadsSelectedValues(): void
    {
        $interaction = $this->interaction([
            'custom_id' => 'colours',
            'component_type' => 3,
            'values' => ['red', 'green'],
        ]);

        $this->assertEquals(['red', 'green'], $interaction->getValues());
        $this->assertEquals('red', $interaction->getValue());
        $this->assertEquals('colours', $interaction->getCustomId());
        $this->assertEquals(MessageComponentType::STRING_SELECT, $interaction->getComponentType());
    }

    public function testAButtonHasNoValues(): void
    {
        $interaction = $this->interaction([
            'custom_id' => 'confirm',
            'component_type' => 2,
        ]);

        $this->assertEquals([], $interaction->getValues());
        $this->assertNull($interaction->getValue());
        $this->assertEquals(MessageComponentType::BUTTON, $interaction->getComponentType());
    }

    public function testAUserSelectCarriesIds(): void
    {
        $interaction = $this->interaction([
            'custom_id' => 'pick-user',
            'component_type' => 5,
            'values' => ['80351110224678912'],
        ]);

        $this->assertEquals('80351110224678912', $interaction->getValue());
        $this->assertEquals(MessageComponentType::USER_SELECT, $interaction->getComponentType());
    }
}
