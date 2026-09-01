<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Handlers;

use Exan\Eventer\EventInterface;
use Exan\Retrier\Retrier;
use Psr\Log\LoggerInterface;
use Tempcord\Discord\Gateway\ConnectionInterface;
use Tempcord\Discord\Gateway\Objects\Payload;

abstract class GatewayEvent implements EventInterface
{
    protected Retrier $retrier;

    public function __construct(
        protected ConnectionInterface $connection,
        protected Payload $payload,
        protected LoggerInterface $logger,
    ) {
        $this->retrier = new Retrier();
    }

    public function filter(): bool
    {
        return true;
    }
}
