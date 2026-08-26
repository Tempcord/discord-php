<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Gateway\Handlers;

use Exan\Eventer\EventInterface;
use Exan\Retrier\Retrier;
use Psr\Log\LoggerInterface;
use CyberWolf\Discord\Gateway\ConnectionInterface;
use CyberWolf\Discord\Gateway\Objects\Payload;

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
