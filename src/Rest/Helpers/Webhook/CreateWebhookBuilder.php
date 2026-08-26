<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Webhook;

use CyberWolf\Discord\Rest\Helpers\GetNew;
use CyberWolf\Discord\Rest\Helpers\Webhook\Shared\SetAvatar;
use CyberWolf\Discord\Rest\Helpers\Webhook\Shared\SetName;

class CreateWebhookBuilder
{
    use GetNew;
    use SetAvatar;
    use SetName;

    private array $data = [];

    public function get(): array
    {
        return $this->data;
    }
}
