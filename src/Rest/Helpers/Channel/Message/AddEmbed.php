<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers\Channel\Message;

use Tempcord\Discord\Exceptions\Rest\Helpers\Message\TooManyEmbedsException;
use Tempcord\Discord\Rest\Helpers\Channel\EmbedBuilder;

trait AddEmbed
{
    /**
     * What Discord takes in one message.
     *
     * Going over is not a dropped embed, it is a Bad Request for the whole
     * message — and the reply that would have carried them never appears.
     * Refused here, where the count is known and the builder can be named.
     */
    public const int MAX_EMBEDS = 10;

    /** @var EmbedBuilder[] */
    private array $embeds;

    /**
     * Deduplicated by url
     * Up to 6000 characters across all text fields
     * Up to 25 fields total
     * @see https://discord.com/developers/docs/resources/channel#embed-object
     */
    /**
     * @throws TooManyEmbedsException
     */
    public function addEmbed(EmbedBuilder $embed): self
    {
        if (!isset($this->embeds)) {
            $this->embeds = [];
        }

        if (count($this->embeds) >= self::MAX_EMBEDS) {
            throw new TooManyEmbedsException(self::MAX_EMBEDS, count($this->embeds) + 1);
        }

        $this->embeds[] = $embed;

        return $this;
    }

    /** @return EmbedBuilder[] */
    public function getEmbeds(): ?array
    {
        return $this->embeds ?? null;
    }

    public function hasEmbeds(): bool
    {
        return isset($this->embeds);
    }
}
