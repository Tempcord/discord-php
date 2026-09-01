<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest\Helpers\Channel;

use Tempcord\Discord\Component\Component;
use Tempcord\Discord\Exceptions\Rest\Helpers\ComponentRowBuilder\TooManyItemsException;
use Tempcord\Discord\Rest\Helpers\Channel\ComponentRowBuilder;
use PHPUnit\Framework\TestCase;

class ComponentRowBuilderTest extends TestCase
{
    public function testGetComponentRow(): void
    {
        $component = new class () extends Component {
            public function get(): array
            {
                return ['::component::'];
            }
        };

        $componentRow = (new ComponentRowBuilder())->add($component);

        $this->assertEquals([
            ['::component::'],
        ], $componentRow->get());
    }

    public function testItThrowsAnErrorOnTooManyComponents(): void
    {
        $component = new class () extends Component {
            public function get(): array
            {
                return ['::component::'];
            }
        };

        $componentRow = new ComponentRowBuilder();

        foreach (range(1, 9) as $count) {
            $componentRow->add($component);
        }

        $this->expectException(TooManyItemsException::class);

        $componentRow->add($component);
    }
}
