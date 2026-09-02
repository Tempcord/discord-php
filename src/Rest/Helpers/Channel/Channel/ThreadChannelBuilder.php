<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers\Channel\Channel;

use Tempcord\Discord\Rest\Helpers\Channel\Channel\Shared\SetRateLimitPerUser;

/**
 * Modifies a thread, including a post in a forum or media channel.
 *
 * A thread is not an ordinary channel: it has no topic, no permission
 * overwrites and no parent to move it between, and it has archiving, locking
 * and — in a forum — tags, which no other channel has. Passing a thread to one
 * of the guild channel builders sends fields Discord rejects for it and offers
 * none of the ones that actually apply.
 *
 * @see https://discord.com/developers/docs/resources/channel#modify-channel-json-params-thread
 */
class ThreadChannelBuilder extends ChannelBuilder
{
    use SetRateLimitPerUser;

    /**
     * The forum tags on this post, given as ids.
     *
     * The whole set is replaced, because that is what Discord does with the
     * field: a tag left out of the list is a tag taken off the post. At most
     * five, and a tag marked as moderated can only be applied by someone with
     * Manage Threads.
     *
     * @param list<string> $tagIds
     */
    public function setAppliedTags(array $tagIds): self
    {
        $this->data['applied_tags'] = array_values($tagIds);

        return $this;
    }

    /**
     * @return list<string>|null
     */
    public function getAppliedTags(): ?array
    {
        return $this->data['applied_tags'] ?? null;
    }

    public function setArchived(bool $archived): self
    {
        $this->data['archived'] = $archived;

        return $this;
    }

    /**
     * A locked thread can still be read, but only a moderator may unarchive it.
     */
    public function setLocked(bool $locked): self
    {
        $this->data['locked'] = $locked;

        return $this;
    }

    /**
     * Whether anyone in the thread may add others to it. Private threads only.
     */
    public function setInvitable(bool $invitable): self
    {
        $this->data['invitable'] = $invitable;

        return $this;
    }

    /**
     * How long the thread sits idle before archiving itself, in minutes.
     * Discord takes 60, 1440, 4320 or 10080.
     */
    public function setAutoArchiveDuration(int $minutes): self
    {
        $this->data['auto_archive_duration'] = $minutes;

        return $this;
    }
}
