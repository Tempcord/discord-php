<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel\Message;

use CyberWolf\Discord\Rest\Helpers\Channel\PollBuilder;

trait SetPoll
{
    public function setPoll(PollBuilder $pollBuilder): static
    {
        $this->data['poll'] = $pollBuilder->get();

        return $this;
    }

    public function getPoll(): ?array
    {
        return $this->data['poll'] ?? null;
    }
}
