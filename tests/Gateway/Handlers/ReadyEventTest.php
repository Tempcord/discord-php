<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Gateway\Handlers;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;
use Psr\Log\NullLogger;
use Tempcord\Discord\Constants\Events;
use Tempcord\Discord\DataMapper;
use Tempcord\Discord\Gateway\ConnectionInterface;
use Tempcord\Discord\Gateway\Handlers\ReadyEvent;
use Tempcord\Discord\Gateway\Objects\Payload;
use PHPUnit\Framework\Attributes\DataProvider;

class ReadyEventTest extends MockeryTestCase
{
    private DataMapper $mapper;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mapper = new DataMapper(new NullLogger());
    }

    #[DataProvider('listenerDataProvider')]
    public function testItListensToTheCorrectEvent(object $payload, bool $expectation): void
    {
        $event = new ReadyEvent(
            Mockery::mock(ConnectionInterface::class),
            $this->mapper->map($payload, Payload::class),
            new NullLogger(),
        );

        $this->assertEquals($expectation, $event->filter());
    }

    public static function listenerDataProvider(): array
    {
        return [
            'Ready event' => [
                'payload' => (object) [
                    't' => Events::READY
                ],
                'expectation' => true,
            ],
            'Other event' => [
                'payload' => (object) [
                    't' => Events::AUTO_MODERATION_ACTION_EXECUTION
                ],
                'expectation' => false,
            ],
            'No type' => [
                'payload' => (object) [],
                'expectation' => false,
            ],
        ];
    }

    #[DataProvider('payloadProvider')]
    public function testItSetsResumeUrlAndSessionId(object $payload, bool $shouldSet): void
    {
        /** @var MockInterface&ConnectionInterface */
        $connection = Mockery::mock(ConnectionInterface::class);
        $event = new ReadyEvent(
            $connection,
            $this->mapper->map($payload, Payload::class),
            new NullLogger(),
        );

        $resumeExpectation = $connection->expects()
            ->setResumeUrl()
            ->with('::resume gateway url::');

        $sessionExpectation = $connection->expects()
            ->setSessionId()
            ->with('::session id::');

        if ($shouldSet) {
            $resumeExpectation->once();
            $sessionExpectation->once();
        } else {
            $resumeExpectation->never();
            $sessionExpectation->never();
        }

        $event->execute();
    }

    public static function payloadProvider(): array
    {
        return [
            'All filled in' => [
                'payload' => (object) [
                    't' => Events::READY,
                    'd' => (object) [
                        'resume_gateway_url' => '::resume gateway url::',
                        'session_id' => '::session id::',
                    ]
                ],
                'shouldSet' => true,
            ],

            'No resume url' => [
                'payload' => (object) [
                    't' => Events::READY,
                    'd' => (object) [
                        'session_id' => '::session id::',
                    ]
                ],
                'shouldSet' => false,
            ],

            'No session id' => [
                'payload' => (object) [
                    't' => Events::READY,
                    'd' => (object) [
                        'resume_gateway_url' => '::resume gateway url::',
                    ]
                ],
                'shouldSet' => false,
            ],

            'No d' => [
                'payload' => (object) [
                    't' => Events::READY,
                ],
                'shouldSet' => false,
            ],
        ];
    }
}
