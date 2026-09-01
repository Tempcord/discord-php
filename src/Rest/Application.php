<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest;

use Tempcord\Discord\Parts\Application as PartsApplication;
use React\Promise\PromiseInterface;

/**
 * @see https://discord.com/developers/docs/resources/application
 */
class Application extends HttpResource
{
    /**
     * @see https://discord.com/developers/docs/resources/application#get-current-application
     *
     * @return PromiseInterface<\Tempcord\Discord\Parts\Application>
     */
    public function getCurrent(): PromiseInterface
    {
        return $this->mapPromise(
            $this->http->get(
                'applications/@me' // @todo update endpoint to Endpoint:: when available
            ),
            PartsApplication::class,
        );
    }

    /**
     * @see https://discord.com/developers/docs/resources/application#edit-current-application
     *
     * @return PromiseInterface<\Tempcord\Discord\Parts\Application>
     */
    public function editCurrent(array $params): PromiseInterface
    {
        return $this->mapPromise(
            $this->http->patch(
                'applications/@me', // @todo update endpoint to Endpoint:: when available
                $params,
            ),
            PartsApplication::class,
        );
    }
}
