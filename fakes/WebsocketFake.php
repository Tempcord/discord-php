<?php

declare(strict_types=1);

namespace Fakes\Tempcord\Discord;

use Evenement\EventEmitter;
use JsonSerializable;
use Tempcord\Discord\Buffer\BufferInterface;
use Tempcord\Discord\Buffer\Passthrough;
use Tempcord\Discord\WebsocketInterface;
use React\Promise\PromiseInterface;

class WebsocketFake extends EventEmitter implements WebsocketInterface
{
    public array $openings = [];
    public array $closings = [];

    /** @var array<int, array|JsonSerializable> every payload sent as JSON */
    public array $sent = [];

    public function __construct(public BufferInterface $buffer = new Passthrough())
    {
    }

    public function getBuffer(): BufferInterface
    {
        return $this->buffer;
    }

    public function open(string $url): PromiseInterface
    {
        $this->openings[] = $url;

        return PromiseFake::get();
    }

    public function close(int $code, string $reason): void
    {
        $this->closings[] = [$code, $reason];
        $this->buffer->reset();
    }

    public function send(string $message, bool $useBucket = true): void
    {
    }

    public function sendAsJson(array|JsonSerializable $item, bool $useBucket): void
    {
        $this->sent[] = $item;
    }
}
