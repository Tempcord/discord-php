<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Guild\Guild\Shared;

use CyberWolf\Discord\Enums\DefaultMessageNotification;

trait SetDefaultMessageNotifications
{
    public function setDefaultMessageNotifications(DefaultMessageNotification $filter): static
    {
        $this->data['default_message_notifications'] = $filter->value;

        return $this;
    }

    public function getDefaultMessageNotifications(): ?DefaultMessageNotification
    {
        return isset($this->data['default_message_notifications'])
            ? DefaultMessageNotification::from($this->data['default_message_notifications'])
            : null;
    }
}
