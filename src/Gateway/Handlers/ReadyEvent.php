<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Handlers;

use Tempcord\Discord\Constants\Events;
use Tempcord\Discord\Constants\OpCodes;

class ReadyEvent extends GatewayEvent
{
    public static function getEventName(): string
    {
        return OpCodes::EVENTS;
    }

    public function filter(): bool
    {
        return isset($this->payload->t) && $this->payload->t === Events::READY;
    }

    public function execute(): void
    {
        if (
            !isset(
                $this->payload->d,
                $this->payload->d->resume_gateway_url,
                $this->payload->d->session_id
            )
        ) {
            return;
        }

        $this->connection->setResumeUrl($this->payload->d->resume_gateway_url);
        $this->connection->setSessionId($this->payload->d->session_id);
    }
}
