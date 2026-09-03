<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;
use Tempcord\Discord\Bitwise\Bitwise;
use Tempcord\Discord\Enums\MessageType;
use Tempcord\Discord\Mapping\ArrayMapping;

class Message
{
    public string $id;
    public string $channel_id;
    public User $author;
    public string $content;
    public Carbon $timestamp;
    public ?Carbon $edited_timestamp = null;
    public bool $tts;
    public bool $mention_everyone;
    /**
     * @var User[]
     */
    #[ArrayMapping(User::class)]
    public array $mentions;
    /**
     * @var string[]
     */
    public array $mention_roles;
    /**
     * @var ChannelMention[]
     */
    #[ArrayMapping(ChannelMention::class)]
    public ?array $mention_channels = null;
    /**
     * @var Attachment[]
     */
    #[ArrayMapping(Attachment::class)]
    public array $attachments;
    /**
     * @var Embed[]
     */
    #[ArrayMapping(Embed::class)]
    public array $embeds;
    /**
     * @var Reaction[]
     */
    #[ArrayMapping(Reaction::class)]
    public ?array $reactions = null;
    public ?string $nonce = null;
    public bool $pinned;
    public ?string $webhook_id = null;
    public ?MessageType $type = null;
    public ?MessageActivity $activity = null;
    public ?Application $application = null;
    public ?string $application_id = null;
    public ?Bitwise $flags = null;
    public ?MessageReference $message_reference = null;
    /**
     * @var MessageSnapshot[]
     */
    #[ArrayMapping(MessageSnapshot::class)]
    public array $message_snapshots;
    public ?Message $referenced_message = null;
    public ?MessageInteractionMetadata $interaction_metadata = null;
    /**
     * @deprecated use $this->interaction_metadata instead
     */
    public ?MessageInteraction $interaction = null;
    public ?Channel $thread = null;
    /**
     * @var Component[]
     */
    #[ArrayMapping(Component::class)]
    public array $components;
    /**
     * @var MessageStickerItem[]
     */
    #[ArrayMapping(MessageStickerItem::class)]
    public ?array $sticker_items = null;
    /**
     * @var Sticker[]
     */
    #[ArrayMapping(Sticker::class)]
    public ?array $stickers = null;
    public ?int $position = null;
    public ?RoleSubscriptionData $role_subscription_data = null;
    public ?MessageResolved $resolved = null;
    public ?Poll $poll = null;
    public MessageCall $call;
}
