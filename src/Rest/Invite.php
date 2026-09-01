<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest;

use Discord\Http\Endpoint;
use Tempcord\Discord\Parts\Invite as PartsInvite;
use React\Promise\PromiseInterface;

/**
 * @see https://discord.com/developers/docs/resources/invite
 */
class Invite extends HttpResource
{
    /**
     * @see https://discord.com/developers/docs/resources/invite#get-invite
     *
     * @return PromiseInterface<\Tempcord\Discord\Parts\Invite>
     */
    public function get(string $code): PromiseInterface
    {
        return $this->mapPromise(
            $this->http->get(
                Endpoint::bind(
                    Endpoint::INVITE,
                    $code
                )
            ),
            PartsInvite::class
        );
    }

    /**
     * @see https://discord.com/developers/docs/resources/invite#delete-invite
     *
     * @return PromiseInterface<void>
     */
    public function delete(string $code): PromiseInterface
    {
        return $this->http->delete(
            Endpoint::bind(
                Endpoint::INVITE,
                $code
            )
        );
    }
}
