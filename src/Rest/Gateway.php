<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest;

use Discord\Http\Endpoint;
use Tempcord\Discord\Parts\Gateway as PartsGateway;
use Tempcord\Discord\Parts\GatewayBot;
use React\Promise\PromiseInterface;

/**
 * @see https://discord.com/developers/docs/events/gateway
 */
class Gateway extends HttpResource
{
    public function get(): PromiseInterface
    {
        return $this->mapPromise(
            $this->http->get(
                Endpoint::GATEWAY
            ),
            PartsGateway::class,
        );
    }

    public function getBot(): PromiseInterface
    {
        return $this->mapPromise(
            $this->http->get(
                Endpoint::GATEWAY_BOT
            ),
            GatewayBot::class,
        );
    }
}
