<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

/**
 * A post in a forum or media channel.
 *
 * A thread in every other respect, but Discord answers the call that creates
 * one with the opening message attached — the only place a channel comes back
 * carrying a message. That message is what reactions and edits address, so it
 * is worth having a name rather than being reached for through a cast.
 *
 * @see https://discord.com/developers/docs/resources/channel#start-thread-in-forum-or-media-channel
 */
class ForumThread extends Channel
{
    public Message $message;
}
