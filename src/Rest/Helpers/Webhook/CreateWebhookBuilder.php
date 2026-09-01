<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers\Webhook;

use Tempcord\Discord\Rest\Helpers\GetNew;
use Tempcord\Discord\Rest\Helpers\Webhook\Shared\SetAvatar;
use Tempcord\Discord\Rest\Helpers\Webhook\Shared\SetName;

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
