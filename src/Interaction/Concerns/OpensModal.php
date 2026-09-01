<?php

declare(strict_types=1);

namespace Tempcord\Discord\Interaction\Concerns;

use Tempcord\Discord\Interaction\Helpers\ModalBuilder;
use Tempcord\Discord\Interaction\Response;
use React\Promise\PromiseInterface;

/**
 * Answering by opening a form.
 *
 * A command and a message component may do this; a submitted modal may not,
 * which is why it is not on every interaction.
 */
trait OpensModal
{
    public function showModal(ModalBuilder $modal): PromiseInterface
    {
        return $this->createInteractionResponse(Response::modal($modal));
    }
}
