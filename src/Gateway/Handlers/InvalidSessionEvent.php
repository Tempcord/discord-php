<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Handlers;

use Tempcord\Discord\Constants\GatewayCloseCodes;
use Tempcord\Discord\Constants\OpCodes;

class InvalidSessionEvent extends GatewayEvent
{
    public static function getEventName(): string
    {
        return OpCodes::INVALID_SESSION;
    }

    public function isRecoverable(): bool
    {
        return isset($this->payload->d) && $this->payload->d === true;
    }

    public function filter(): bool
    {
        return !$this->isRecoverable();
    }

    public function execute(): void
    {
        $this->connection->disconnect(
            GatewayCloseCodes::LIB_INSTANTIATED_RECONNECT,
            'Invalid session, attempting to establish new connection'
        );
    }
}
