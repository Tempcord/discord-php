<?php

declare(strict_types=1);

namespace Tempcord\Discord\Gateway\Helpers;

use Tempcord\Discord\Exceptions\Gateway\Helpers\RequestGuildMembers\InvalidRequestException;
use Tempcord\Discord\Rest\Helpers\GetNew;

/**
 * Asks the gateway for a guild's members.
 *
 * GUILD_CREATE only carries the full member list for a small guild; past that
 * Discord sends a slice and expects to be asked for the rest. The answer comes
 * back as one or more GUILD_MEMBERS_CHUNK events rather than as a response.
 *
 * @see https://discord.com/developers/docs/topics/gateway-events#request-guild-members
 */
class RequestGuildMembersBuilder
{
    use GetNew;

    private string $guildId;

    private ?string $query = null;

    private ?int $limit = null;

    private ?bool $presences = null;

    /** @var string[]|null */
    private ?array $userIds = null;

    private ?string $nonce = null;

    public function setGuildId(string $guildId): self
    {
        $this->guildId = $guildId;

        return $this;
    }

    public function getGuildId(): ?string
    {
        return $this->guildId ?? null;
    }

    /**
     * Asks only for members whose username starts with this. An empty string,
     * which is the default when asking for everyone, matches all of them.
     */
    public function setQuery(string $query): self
    {
        $this->query = $query;

        return $this;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * How many members to return. Zero means every match, and is the only value
     * Discord accepts alongside an empty query.
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Whether to send each member's presence along with them. Requires the
     * GUILD_PRESENCES intent.
     */
    public function setPresences(bool $presences): self
    {
        $this->presences = $presences;

        return $this;
    }

    public function getPresences(): ?bool
    {
        return $this->presences;
    }

    /**
     * Asks for specific members instead of searching by name.
     *
     * @param string[] $userIds
     */
    public function setUserIds(array $userIds): self
    {
        $this->userIds = array_values($userIds);

        return $this;
    }

    /** @return string[]|null */
    public function getUserIds(): ?array
    {
        return $this->userIds;
    }

    /**
     * Echoed back on every chunk, so the answer to this request can be told
     * apart from the answer to another one.
     */
    public function setNonce(string $nonce): self
    {
        $this->nonce = $nonce;

        return $this;
    }

    public function getNonce(): ?string
    {
        return $this->nonce;
    }

    /**
     * Everyone in the guild, which is what a cache wants.
     */
    public static function everyone(string $guildId): self
    {
        return self::new()
            ->setGuildId($guildId)
            ->setQuery('')
            ->setLimit(0);
    }

    /**
     * @throws InvalidRequestException
     */
    public function get(): array
    {
        if (!isset($this->guildId)) {
            throw new InvalidRequestException('A guild must be given to request members from');
        }

        /*
         * Discord requires one of the two, and rejects a request carrying
         * neither — silently, by never answering, which is worth catching here
         * rather than waiting on a chunk that will not arrive.
         */
        if ($this->query === null && $this->userIds === null) {
            throw new InvalidRequestException('Either a query or a list of user ids must be given');
        }

        $data = ['guild_id' => $this->guildId];

        if ($this->userIds !== null) {
            $data['user_ids'] = $this->userIds;
        } else {
            $data['query'] = $this->query;
        }

        if ($this->limit !== null) {
            $data['limit'] = $this->limit;
        }

        if ($this->presences !== null) {
            $data['presences'] = $this->presences;
        }

        if ($this->nonce !== null) {
            $data['nonce'] = $this->nonce;
        }

        return $data;
    }
}
