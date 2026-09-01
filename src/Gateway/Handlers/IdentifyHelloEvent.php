<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Handlers;

class IdentifyHelloEvent extends IdentifyEvent
{
    public function execute(): void
    {
        $this->connection->identify();
        parent::execute();
    }
}
