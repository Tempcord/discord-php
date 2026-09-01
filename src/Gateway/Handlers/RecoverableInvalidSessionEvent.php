<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Handlers;

use Tempcord\Discord\Constants\GatewayCloseCodes;

class RecoverableInvalidSessionEvent extends InvalidSessionEvent
{
    public function filter(): bool
    {
        return $this->isRecoverable();
    }

    public function execute(): void
    {
        $this->connection->disconnect(
            GatewayCloseCodes::LIB_INSTANTIATED_RESUME,
            'Received opcode 9 with recoverable indicator, attempting resume'
        );
    }
}
