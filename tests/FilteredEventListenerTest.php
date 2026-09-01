<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord;

use Evenement\EventEmitter;
use Tempcord\Discord\Constants\Events;
use Tempcord\Discord\EventHandler;
use Tempcord\Discord\FilteredEventEmitter;
use Tempcord\Discord\Gateway\Objects\Payload;
use Fakes\Tempcord\Discord\DataMapperFake;
use Fakes\Tempcord\Discord\PromiseFake;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use React\EventLoop\LoopInterface;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class FilteredEventListenerTest extends MockeryTestCase
{
    public function testFilteringEvents(): void
    {

        $eventEmitter = new EventEmitter();

        $filteredEmitter = new FilteredEventEmitter(
            $eventEmitter,
            'event',
            static fn (int $input) => $input === 10
        );

        $container = [];
        $filteredEmitter->on('event', static function (int $input) use (&$container) {
            $container[] = $input;
        });

        $filteredEmitter->start();

        $eventEmitter->emit('event', [5]);
        $eventEmitter->emit('event', [10]);

        $this->assertEquals([10], $container);
    }

    public function testCancelEvent(): void
    {
        $eventEmitter = new EventEmitter();

        $filteredEmitter = new FilteredEventEmitter(
            $eventEmitter,
            'event',
            static function () {
            }
        );

        $filteredEmitter->start();
        $this->assertCount(1, $eventEmitter->listeners('event'));

        $filteredEmitter->cancel();
        $this->assertCount(0, $eventEmitter->listeners('event'));
    }

    public function testCancelByMaxItems(): void
    {
        $eventEmitter = new EventEmitter();

        $filteredEmitter = new FilteredEventEmitter(
            $eventEmitter,
            'event',
            static fn (int $input) => $input === 10,
            maxItems: 3
        );

        $filteredEmitter->start();

        $eventEmitter->emit('event', [5]);
        $eventEmitter->emit('event', [10]);
        $eventEmitter->emit('event', [10]);
        $this->assertCount(1, $eventEmitter->listeners('event'));

        $eventEmitter->emit('event', [10]);
        $this->assertCount(0, $eventEmitter->listeners('event'));
    }

    /**
     * Mockery's overload: defines the class itself, so it can only run where
     * the real React\EventLoop\Loop has not been autoloaded yet — which any
     * earlier test in the same process may have done.
     */
    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function testCancelByTimeout(): void
    {
        /**
         * @var Mock
         */
        $loop = Mockery::mock(LoopInterface::class);

        /**
         * @var Mock
         */
        $loopMock = Mockery::mock('overload:React\EventLoop\Loop');
        $loopMock->shouldReceive('get')->andReturn(
            $loop
        );

        $canceller = null;

        $loop->shouldReceive('addTimer')
            ->andReturnUsing(
                function (float $seconds, callable $handler) use (&$canceller) {
                    $this->assertEquals(10, $seconds);

                    $canceller = $handler;
                }
            );

        // </mocking

        $eventEmitter = new EventEmitter();

        $filteredEmitter = new FilteredEventEmitter(
            $eventEmitter,
            'event',
            static fn (int $input) => $input === 10,
            10
        );

        $filteredEmitter->start();

        $loop->shouldHaveReceived('addTimer')->once();

        $this->assertCount(1, $eventEmitter->listeners('event'));

        $canceller();

        $this->assertCount(0, $eventEmitter->listeners('event'));
    }

    public function testItAcceptsEventHandler(): void
    {
        $eventHandler = new EventHandler(DataMapperFake::get());

        $filteredEmitter = new FilteredEventEmitter(
            $eventHandler,
            Events::MESSAGE_CREATE,
            static fn ($item) => $item === '::item::',
        );

        $container = [];
        $filteredEmitter->on(Events::MESSAGE_CREATE, static function ($item) use (&$container) {
            $container[] = $item;
        });

        $filteredEmitter->start();

        $eventHandler->emit(Events::MESSAGE_CREATE, ['::item::']);

        $this->assertCount(1, $container);
    }

    public function testFilteringEventsAsync(): void
    {

        $eventEmitter = new EventEmitter();

        $filteredEmitter = new FilteredEventEmitter(
            $eventEmitter,
            'event',
            static fn (int $input) => PromiseFake::get($input === 10)
        );

        $container = [];
        $filteredEmitter->on('event', static function (int $input) use (&$container) {
            $container[] = $input;
        });

        $filteredEmitter->start();

        $eventEmitter->emit('event', [5]);
        $eventEmitter->emit('event', [10]);

        $this->assertEquals([10], $container);
    }
}
