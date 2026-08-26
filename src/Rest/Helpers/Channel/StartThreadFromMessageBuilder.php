<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel;

use CyberWolf\Discord\Constants\Validation\RateLimit;
use CyberWolf\Discord\Enums\ThreadAutoArchiveDuration;
use CyberWolf\Discord\Rest\Helpers\GetNew;

class StartThreadFromMessageBuilder
{
    use GetNew;

    private array $data = [];

    public function setName(string $name): self
    {
        $this->data['name'] = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    public function setAutoArchiveDuration(ThreadAutoArchiveDuration $duration): self
    {
        $this->data['auto_archive_duration'] = $duration->value;

        return $this;
    }

    public function getAutoArchiveDuration(): ?ThreadAutoArchiveDuration
    {
        return isset($this->data['auto_archive_duration'])
            ? ThreadAutoArchiveDuration::from($this->data['auto_archive_duration'])
            : null;
    }

    public function setRateLimitPerUser(int $seconds): self
    {
        $this->data['rate_limit_per_user'] = RateLimit::withinLimit($seconds);

        return $this;
    }

    public function getRateLimitPerUser(): ?int
    {
        return $this->data['rate_limit_per_user'] ?? null;
    }

    public function get(): array
    {
        return $this->data;
    }
}
