<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel\Channel;

use CyberWolf\Discord\Bitwise\Bitwise;
use CyberWolf\Discord\Enums\ChannelFlag;
use CyberWolf\Discord\Enums\ChannelType;
use CyberWolf\Discord\Enums\ForumLayoutType;
use CyberWolf\Discord\Enums\SortOrderType;
use CyberWolf\Discord\Exceptions\Rest\Helpers\Channel\Channel\GuildForumChannelBuilder\TooManyAvailableTagsException;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetDefaultAutoArchiveDuration;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetDefaultThreadRateLimitPerUser;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetNsfw;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetParentId;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetRateLimitPerUser;
use CyberWolf\Discord\Rest\Helpers\Channel\Channel\Shared\SetTopic;
use CyberWolf\Discord\Rest\Helpers\Emoji\EmojiBuilder;

/**
 * @see https://discord.com/developers/docs/resources/channel#modify-channel
 */
class GuildForumChannelBuilder extends ChannelBuilder
{
    use SetTopic;
    use SetNsfw;
    use SetRateLimitPerUser;
    use SetParentId;
    use SetDefaultAutoArchiveDuration;
    use SetDefaultThreadRateLimitPerUser;

    private Bitwise $channelFlags;

    public function __construct()
    {
        $this->setChannelType(ChannelType::GUILD_FORUM);
    }

    public function addFlag(ChannelFlag $flag): self
    {
        if (!isset($this->channelFlags)) {
            $this->channelFlags = new Bitwise();
        }

        $this->channelFlags->add($flag);

        $this->data['flags'] = $this->channelFlags->get();

        return $this;
    }

    /**
     * Can not exceed 20 available tags
     *
     * @see https://discord.com/developers/docs/resources/channel#forum-tag-object
     *
     * @throws TooManyAvailableTagsException
     */
    public function addAvailableTag(
        string $name,
        ?bool $moderated = null,
        ?EmojiBuilder $emoji = null
    ): self {
        if (!isset($this->data['available_tags'])) {
            $this->data['available_tags'] = [];
        } elseif (count($this->data['available_tags']) === 20) {
            throw new TooManyAvailableTagsException();
        }

        $tag = ['name' => $name];

        $this->data['available_tags'][] = &$tag;

        if (!is_null($moderated)) {
            $tag['moderated'] = $moderated;
        }

        if (!isset($emoji)) {
            return $this;
        }

        if (!is_null($emoji)) {
            $emojiData = $emoji->get();

            $add = isset($emojiData['name'])
                ? ['emoji_id' => $emojiData['id']]
                : ['emoji_name' => $emojiData['id']];

            $tag = [...$tag, ...$add];
        }

        return $this;
    }

    public function setDefaultReactionEmoji(EmojiBuilder $emoji): self
    {
        $emojiData = $emoji->get();

        $this->data['default_reaction_emoji'] = isset($emojiData['name'])
            ? ['emoji_id' => $emojiData['id']]
            : ['emoji_name' => $emojiData['id']];

        return $this;
    }

    public function setDefaultSortOrder(SortOrderType $sortOrderType): self
    {
        $this->data['default_sort_order'] = $sortOrderType->value;

        return $this;
    }

    public function setDefaultForumLayout(ForumLayoutType $formLayoutType): self
    {
        $this->data['default_forum_layout'] = $formLayoutType->value;

        return $this;
    }
}
