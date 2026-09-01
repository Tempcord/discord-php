<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers\Webhook;

use Tempcord\Discord\Rest\Helpers\GetNew;
use Tempcord\Discord\Rest\Helpers\Webhook\Shared\SetAvatar;
use Tempcord\Discord\Rest\Helpers\Webhook\Shared\SetName;

class ModifyWebhookBuilder
{
    use GetNew;
    use SetAvatar;
    use SetName;

    private array $data = [];

    public function setChannelId(string $channelId): static
    {
        $this->data['channel_id'] = $channelId;

        return $this;
    }

    public function getChannelId(): ?string
    {
        return $this->data['channel_id'] ?? null;
    }

    public function get(): array
    {
        return $this->data;
    }
}
