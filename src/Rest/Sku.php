<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest;

use Discord\Http\Endpoint;
use CyberWolf\Discord\Parts\Sku as SkuPart;
use React\Promise\PromiseInterface;

/**
 * @see https://discord.com/developers/docs/resources/sku
 */
class Sku extends HttpResource
{
    /**
     * Subscription SKUs each come with a system generated SUBSCRIPTION_GROUP
     * alongside them, so the list is longer than the number of offerings
     * configured for the application.
     *
     * @see https://discord.com/developers/docs/resources/sku#list-skus
     *
     * @return PromiseInterface<\CyberWolf\Discord\Parts\Sku[]>
     */
    public function listSkus(string $applicationId): PromiseInterface
    {
        return $this->mapArrayPromise(
            $this->http->get(
                Endpoint::bind(
                    Endpoint::APPLICATION_SKUS,
                    $applicationId
                )
            ),
            SkuPart::class
        );
    }
}
