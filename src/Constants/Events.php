<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Constants;

class Events
{
    final public const RAW = 'RAW';
    final public const READY = 'READY';

    final public const APPLICATION_COMMAND_PERMISSIONS_UPDATE = 'APPLICATION_COMMAND_PERMISSIONS_UPDATE';
    final public const AUTO_MODERATION_RULE_CREATE = 'AUTO_MODERATION_RULE_CREATE';
    final public const AUTO_MODERATION_RULE_UPDATE = 'AUTO_MODERATION_RULE_UPDATE';
    final public const AUTO_MODERATION_RULE_DELETE = 'AUTO_MODERATION_RULE_DELETE';
    final public const AUTO_MODERATION_ACTION_EXECUTION = 'AUTO_MODERATION_ACTION_EXECUTION';

    final public const CHANNEL_CREATE = 'CHANNEL_CREATE';
    final public const CHANNEL_UPDATE = 'CHANNEL_UPDATE';
    final public const CHANNEL_DELETE = 'CHANNEL_DELETE';
    final public const CHANNEL_PINS_UPDATE = 'CHANNEL_PINS_UPDATE';

    final public const THREAD_CREATE = 'THREAD_CREATE';
    final public const THREAD_UPDATE = 'THREAD_UPDATE';
    final public const THREAD_DELETE = 'THREAD_DELETE';
    final public const THREAD_LIST_SYNC = 'THREAD_LIST_SYNC';
    final public const THREAD_MEMBER_UPDATE = 'THREAD_MEMBER_UPDATE';
    final public const THREAD_MEMBERS_UPDATE = 'THREAD_MEMBERS_UPDATE';

    final public const ENTITLEMENT_CREATE = 'ENTITLEMENT_CREATE';
    final public const ENTITLEMENT_UPDATE = 'ENTITLEMENT_UPDATE';
    final public const ENTITLEMENT_DELETE = 'ENTITLEMENT_DELETE';

    final public const GUILD_CREATE = 'GUILD_CREATE';
    final public const GUILD_UPDATE = 'GUILD_UPDATE';
    final public const GUILD_DELETE = 'GUILD_DELETE';

    final public const GUILD_AUDIT_LOG_ENTRY_CREATE = 'GUILD_AUDIT_LOG_ENTRY_CREATE';

    final public const GUILD_BAN_ADD = 'GUILD_BAN_ADD';
    final public const GUILD_BAN_REMOVE = 'GUILD_BAN_REMOVE';

    final public const GUILD_EMOJIS_UPDATE = 'GUILD_EMOJIS_UPDATE';
    final public const GUILD_STICKERS_UPDATE = 'GUILD_STICKERS_UPDATE';

    final public const GUILD_INTEGRATIONS_UPDATE = 'GUILD_INTEGRATIONS_UPDATE';

    final public const GUILD_MEMBER_ADD = 'GUILD_MEMBER_ADD';
    final public const GUILD_MEMBER_REMOVE = 'GUILD_MEMBER_REMOVE';
    final public const GUILD_MEMBER_UPDATE = 'GUILD_MEMBER_UPDATE';
    final public const GUILD_MEMBERS_CHUNK = 'GUILD_MEMBERS_CHUNK';

    final public const GUILD_ROLE_CREATE = 'GUILD_ROLE_CREATE';
    final public const GUILD_ROLE_UPDATE = 'GUILD_ROLE_UPDATE';
    final public const GUILD_ROLE_DELETE = 'GUILD_ROLE_DELETE';

    final public const GUILD_SCHEDULED_EVENT_CREATE = 'GUILD_SCHEDULED_EVENT_CREATE';
    final public const GUILD_SCHEDULED_EVENT_UPDATE = 'GUILD_SCHEDULED_EVENT_UPDATE';
    final public const GUILD_SCHEDULED_EVENT_DELETE = 'GUILD_SCHEDULED_EVENT_DELETE';
    final public const GUILD_SCHEDULED_EVENT_USER_ADD = 'GUILD_SCHEDULED_EVENT_USER_ADD';
    final public const GUILD_SCHEDULED_EVENT_USER_REMOVE = 'GUILD_SCHEDULED_EVENT_USER_REMOVE';

    final public const GUILD_SOUNDBOARD_SOUND_CREATE = 'GUILD_SOUNDBOARD_SOUND_CREATE';
    final public const GUILD_SOUNDBOARD_SOUND_UPDATE = 'GUILD_SOUNDBOARD_SOUND_UPDATE';
    final public const GUILD_SOUNDBOARD_SOUND_DELETE = 'GUILD_SOUNDBOARD_SOUND_DELETE';
    final public const GUILD_SOUNDBOARD_SOUNDS_UPDATE = 'GUILD_SOUNDBOARD_SOUNDS_UPDATE';
    final public const SOUNDBOARD_SOUNDS = 'SOUNDBOARD_SOUNDS';

    final public const INTEGRATION_CREATE = 'INTEGRATION_CREATE';
    final public const INTEGRATION_UPDATE = 'INTEGRATION_UPDATE';
    final public const INTEGRATION_DELETE = 'INTEGRATION_DELETE';

    final public const INTERACTION_CREATE = 'INTERACTION_CREATE';

    final public const INVITE_CREATE = 'INVITE_CREATE';
    final public const INVITE_DELETE = 'INVITE_DELETE';

    final public const MESSAGE_CREATE = 'MESSAGE_CREATE';
    final public const MESSAGE_UPDATE = 'MESSAGE_UPDATE';
    final public const MESSAGE_DELETE = 'MESSAGE_DELETE';
    final public const MESSAGE_DELETE_BULK = 'MESSAGE_DELETE_BULK';
    final public const MESSAGE_REACTION_ADD = 'MESSAGE_REACTION_ADD';
    final public const MESSAGE_REACTION_REMOVE = 'MESSAGE_REACTION_REMOVE';
    final public const MESSAGE_REACTION_REMOVE_ALL = 'MESSAGE_REACTION_REMOVE_ALL';
    final public const MESSAGE_REACTION_REMOVE_EMOJI = 'MESSAGE_REACTION_REMOVE_EMOJI';

    final public const PRESENCE_UPDATE = 'PRESENCE_UPDATE';

    final public const STAGE_INSTANCE_CREATE = 'STAGE_INSTANCE_CREATE';
    final public const STAGE_INSTANCE_UPDATE = 'STAGE_INSTANCE_UPDATE';
    final public const STAGE_INSTANCE_DELETE = 'STAGE_INSTANCE_DELETE';

    final public const SUBSCRIPTION_CREATE = 'SUBSCRIPTION_CREATE';
    final public const SUBSCRIPTION_UPDATE = 'SUBSCRIPTION_UPDATE';
    final public const SUBSCRIPTION_DELETE = 'SUBSCRIPTION_DELETE';

    final public const TYPING_START = 'TYPING_START';
    final public const USER_UPDATE = 'USER_UPDATE';

    final public const VOICE_STATE_UPDATE = 'VOICE_STATE_UPDATE';
    final public const VOICE_SERVER_UPDATE = 'VOICE_SERVER_UPDATE';

    final public const WEBHOOKS_UPDATE = 'WEBHOOKS_UPDATE';

    final public const MAPPINGS = [
        self::READY => \CyberWolf\Discord\Gateway\Events\Ready::class,

        self::APPLICATION_COMMAND_PERMISSIONS_UPDATE =>
            \CyberWolf\Discord\Gateway\Events\ApplicationCommandPermissionsUpdate::class,
        self::AUTO_MODERATION_RULE_CREATE => \CyberWolf\Discord\Gateway\Events\AutoModerationRuleCreate::class,
        self::AUTO_MODERATION_RULE_UPDATE => \CyberWolf\Discord\Gateway\Events\AutoModerationRuleUpdate::class,
        self::AUTO_MODERATION_RULE_DELETE => \CyberWolf\Discord\Gateway\Events\AutoModerationRuleDelete::class,
        self::AUTO_MODERATION_ACTION_EXECUTION =>
            \CyberWolf\Discord\Gateway\Events\AutoModerationActionExecution::class,

        self::CHANNEL_CREATE => \CyberWolf\Discord\Gateway\Events\ChannelCreate::class,
        self::CHANNEL_UPDATE => \CyberWolf\Discord\Gateway\Events\ChannelUpdate::class,
        self::CHANNEL_DELETE => \CyberWolf\Discord\Gateway\Events\ChannelDelete::class,
        self::CHANNEL_PINS_UPDATE => \CyberWolf\Discord\Gateway\Events\ChannelPinsUpdate::class,

        self::THREAD_CREATE => \CyberWolf\Discord\Gateway\Events\ThreadCreate::class,
        self::THREAD_UPDATE => \CyberWolf\Discord\Gateway\Events\ThreadUpdate::class,
        self::THREAD_DELETE => \CyberWolf\Discord\Gateway\Events\ThreadDelete::class,
        self::THREAD_LIST_SYNC => \CyberWolf\Discord\Gateway\Events\ThreadListSync::class,
        self::THREAD_MEMBER_UPDATE => \CyberWolf\Discord\Gateway\Events\ThreadMemberUpdate::class,
        self::THREAD_MEMBERS_UPDATE => \CyberWolf\Discord\Gateway\Events\ThreadMembersUpdate::class,

        self::ENTITLEMENT_CREATE => \CyberWolf\Discord\Gateway\Events\EntitlementCreate::class,
        self::ENTITLEMENT_UPDATE => \CyberWolf\Discord\Gateway\Events\EntitlementUpdate::class,
        self::ENTITLEMENT_DELETE => \CyberWolf\Discord\Gateway\Events\EntitlementDelete::class,

        self::GUILD_CREATE => \CyberWolf\Discord\Gateway\Events\GuildCreate::class,
        self::GUILD_UPDATE => \CyberWolf\Discord\Gateway\Events\GuildUpdate::class,
        self::GUILD_DELETE => \CyberWolf\Discord\Gateway\Events\GuildDelete::class,

        self::GUILD_AUDIT_LOG_ENTRY_CREATE =>
            \CyberWolf\Discord\Gateway\Events\GuildAuditLogEntryCreate::class,

        self::GUILD_BAN_ADD => \CyberWolf\Discord\Gateway\Events\GuildBanAdd::class,
        self::GUILD_BAN_REMOVE => \CyberWolf\Discord\Gateway\Events\GuildBanRemove::class,

        self::GUILD_EMOJIS_UPDATE => \CyberWolf\Discord\Gateway\Events\GuildEmojisUpdate::class,
        self::GUILD_STICKERS_UPDATE => \CyberWolf\Discord\Gateway\Events\GuildStickersUpdate::class,

        self::GUILD_INTEGRATIONS_UPDATE => \CyberWolf\Discord\Gateway\Events\GuildIntegrationsUpdate::class,

        self::GUILD_MEMBER_ADD => \CyberWolf\Discord\Gateway\Events\GuildMemberAdd::class,
        self::GUILD_MEMBER_REMOVE => \CyberWolf\Discord\Gateway\Events\GuildMemberRemove::class,
        self::GUILD_MEMBER_UPDATE => \CyberWolf\Discord\Gateway\Events\GuildMemberUpdate::class,
        self::GUILD_MEMBERS_CHUNK => \CyberWolf\Discord\Gateway\Events\GuildMembersChunk::class,

        self::GUILD_ROLE_CREATE => \CyberWolf\Discord\Gateway\Events\GuildRoleCreate::class,
        self::GUILD_ROLE_UPDATE => \CyberWolf\Discord\Gateway\Events\GuildRoleUpdate::class,
        self::GUILD_ROLE_DELETE => \CyberWolf\Discord\Gateway\Events\GuildRoleDelete::class,

        self::GUILD_SCHEDULED_EVENT_CREATE => \CyberWolf\Discord\Gateway\Events\GuildScheduledEventCreate::class,
        self::GUILD_SCHEDULED_EVENT_UPDATE => \CyberWolf\Discord\Gateway\Events\GuildScheduledEventUpdate::class,
        self::GUILD_SCHEDULED_EVENT_DELETE => \CyberWolf\Discord\Gateway\Events\GuildScheduledEventDelete::class,
        self::GUILD_SCHEDULED_EVENT_USER_ADD => \CyberWolf\Discord\Gateway\Events\GuildScheduledEventUserAdd::class,
        self::GUILD_SCHEDULED_EVENT_USER_REMOVE =>
            \CyberWolf\Discord\Gateway\Events\GuildScheduledEventUserRemove::class,

        self::GUILD_SOUNDBOARD_SOUND_CREATE => \CyberWolf\Discord\Gateway\Events\GuildSoundboardSoundCreate::class,
        self::GUILD_SOUNDBOARD_SOUND_UPDATE => \CyberWolf\Discord\Gateway\Events\GuildSoundboardSoundUpdate::class,
        self::GUILD_SOUNDBOARD_SOUND_DELETE => \CyberWolf\Discord\Gateway\Events\GuildSoundboardSoundDelete::class,
        self::GUILD_SOUNDBOARD_SOUNDS_UPDATE =>
            \CyberWolf\Discord\Gateway\Events\GuildSoundboardSoundsUpdate::class,
        self::SOUNDBOARD_SOUNDS => \CyberWolf\Discord\Gateway\Events\SoundboardSounds::class,

        self::INTEGRATION_CREATE => \CyberWolf\Discord\Gateway\Events\IntegrationCreate::class,
        self::INTEGRATION_UPDATE => \CyberWolf\Discord\Gateway\Events\IntegrationUpdate::class,
        self::INTEGRATION_DELETE => \CyberWolf\Discord\Gateway\Events\IntegrationDelete::class,
        self::INTERACTION_CREATE => \CyberWolf\Discord\Gateway\Events\InteractionCreate::class,

        self::INVITE_CREATE => \CyberWolf\Discord\Gateway\Events\InviteCreate::class,
        self::INVITE_DELETE => \CyberWolf\Discord\Gateway\Events\InviteDelete::class,

        self::MESSAGE_CREATE => \CyberWolf\Discord\Gateway\Events\MessageCreate::class,
        self::MESSAGE_UPDATE => \CyberWolf\Discord\Gateway\Events\MessageUpdate::class,
        self::MESSAGE_DELETE => \CyberWolf\Discord\Gateway\Events\MessageDelete::class,
        self::MESSAGE_DELETE_BULK => \CyberWolf\Discord\Gateway\Events\MessageDeleteBulk::class,
        self::MESSAGE_REACTION_ADD => \CyberWolf\Discord\Gateway\Events\MessageReactionAdd::class,
        self::MESSAGE_REACTION_REMOVE => \CyberWolf\Discord\Gateway\Events\MessageReactionRemove::class,
        self::MESSAGE_REACTION_REMOVE_ALL => \CyberWolf\Discord\Gateway\Events\MessageReactionRemoveAll::class,
        self::MESSAGE_REACTION_REMOVE_EMOJI => \CyberWolf\Discord\Gateway\Events\MessageReactionRemoveEmoji::class,

        self::PRESENCE_UPDATE => \CyberWolf\Discord\Gateway\Events\PresenceUpdate::class,

        self::STAGE_INSTANCE_CREATE => \CyberWolf\Discord\Gateway\Events\StageInstanceCreate::class,
        self::STAGE_INSTANCE_UPDATE => \CyberWolf\Discord\Gateway\Events\StageInstanceUpdate::class,
        self::STAGE_INSTANCE_DELETE => \CyberWolf\Discord\Gateway\Events\StageInstanceDelete::class,

        self::SUBSCRIPTION_CREATE => \CyberWolf\Discord\Gateway\Events\SubscriptionCreate::class,
        self::SUBSCRIPTION_UPDATE => \CyberWolf\Discord\Gateway\Events\SubscriptionUpdate::class,
        self::SUBSCRIPTION_DELETE => \CyberWolf\Discord\Gateway\Events\SubscriptionDelete::class,

        self::TYPING_START => \CyberWolf\Discord\Gateway\Events\TypingStart::class,
        self::USER_UPDATE => \CyberWolf\Discord\Gateway\Events\UserUpdate::class,

        self::VOICE_STATE_UPDATE => \CyberWolf\Discord\Gateway\Events\VoiceStateUpdate::class,
        self::VOICE_SERVER_UPDATE => \CyberWolf\Discord\Gateway\Events\VoiceServerUpdate::class,

        self::WEBHOOKS_UPDATE => \CyberWolf\Discord\Gateway\Events\WebhooksUpdate::class,
    ];
}
