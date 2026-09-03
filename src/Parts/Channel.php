<?php

declare(strict_types=1);

namespace Tempcord\Discord\Parts;

use Carbon\Carbon;
use Tempcord\Discord\Bitwise\Bitwise;
use Tempcord\Discord\Enums\ChannelType;
use Tempcord\Discord\Enums\ForumLayoutType;
use Tempcord\Discord\Enums\SortOrderType;
use Tempcord\Discord\Enums\VideoQualityMode;
use Tempcord\Discord\Mapping\ArrayMapping;

class Channel
{
    public string $id;
    public ChannelType $type;
    public ?string $guild_id = null;
    public ?int $position = null;
    /**
     * @var Overwrite[]
     */
    #[ArrayMapping(Overwrite::class)]
    public ?array $permission_overwrites = null;
    public ?string $name = null;
    public ?string $topic = null;
    public ?bool $nsfw = null;
    public ?string $last_message_id = null;
    public ?int $bitrate = null;
    public ?int $user_limit = null;
    public ?int $rate_limit_per_user = null;
    /**
     * @var User[]
     */
    #[ArrayMapping(User::class)]
    public ?array $recipients = null;
    public ?string $icon = null;
    public ?string $owner_id = null;
    public ?string $application_id = null;
    public ?string $parent_id = null;
    public ?Carbon $last_pin_timestamp = null;
    public ?string $rtc_region = null;
    public ?VideoQualityMode $video_quality_mode = null;
    public ?int $message_count = null;
    public ?int $member_count = null;
    public ?ThreadMetadata $thread_metadata = null;
    public ?ThreadMember $member = null;
    public ?int $default_auto_archive_duration = null;
    public ?string $permissions = null;
    public ?Bitwise $flags = null;
    public ?int $total_message_sent = null;
    /**
     * @var Tag[]
     */
    #[ArrayMapping(Tag::class)]
    public ?array $available_tags = null;
    /**
     * @var string[]
     */
    public ?array $applied_tags = null;
    public ?DefaultReaction $default_reaction_emoji = null;
    public ?int $default_thread_rate_limit_per_user = null;
    public ?SortOrderType $default_sort_order = null;
    public ?ForumLayoutType $default_forum_layout = null;
}
