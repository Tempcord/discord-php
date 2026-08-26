<?php

declare(strict_types=1);

namespace CyberWolf\Discord;

use Evenement\EventEmitter;
use CyberWolf\Discord\Constants\Events;
use CyberWolf\Discord\Gateway\Objects\Payload;

class EventHandler extends EventEmitter
{
    public function __construct(private DataMapper $mapper)
    {
    }

    public function handle(Payload $payload): void
    {
        if (!isset(Events::MAPPINGS[$payload->t]) || !$this->hasListener($payload->t)) {
            return;
        }

        $eventClass = Events::MAPPINGS[$payload->t];

        $this->emit(
            $payload->t,
            [
                $this->mapper->map(
                    $payload->d,
                    $eventClass
                )
            ]
        );
    }

    public function hasListener(string $event): bool
    {
        return isset($this->listeners[$event]) || isset($this->onceListeners[$event]);
    }
}
