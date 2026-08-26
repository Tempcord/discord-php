<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Webhook;

use Discord\Http\Multipart\MultipartBody;
use CyberWolf\Discord\Rest\Helpers\Channel\AttachmentBuilder;
use CyberWolf\Discord\Rest\Helpers\Channel\EmbedBuilder;
use CyberWolf\Discord\Rest\Helpers\Channel\Message\AddAttachment;
use CyberWolf\Discord\Rest\Helpers\Channel\Message\AddComponent;
use CyberWolf\Discord\Rest\Helpers\Channel\Message\AddEmbed;
use CyberWolf\Discord\Rest\Helpers\Channel\Message\AddFile;
use CyberWolf\Discord\Rest\Helpers\Channel\Message\AllowMentions;
use CyberWolf\Discord\Rest\Helpers\Channel\Message\MultipartMessage;
use CyberWolf\Discord\Rest\Helpers\Channel\Message\SetContent;
use CyberWolf\Discord\Rest\Helpers\Channel\Message\SetFlags;
use CyberWolf\Discord\Rest\Helpers\Channel\Message\SetTts;
use CyberWolf\Discord\Rest\Helpers\GetNew;

/**
 * @see https://discord.com/developers/docs/resources/webhook#execute-webhook
 */
class WebhookBuilder
{
    use GetNew;

    use AddAttachment;
    use AddComponent;
    use AddEmbed;
    use AddFile;
    use AllowMentions;
    use SetContent;
    use SetFlags;
    use MultipartMessage;
    use SetTts;

    private array $data = [];

    public function setUsername(string $username): self
    {
        $this->data['username'] = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->data['username'] ?? null;
    }

    public function setAvatarUrl(string $url): self
    {
        $this->data['avatar_url'] = $url;

        return $this;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->data['avatar_url'] ?? null;
    }

    public function setThreadName(string $name): self
    {
        $this->data['thread_name'] = $name;

        return $this;
    }

    public function getThreadName(): ?string
    {
        return $this->data['thread_name'] ?? null;
    }

    public function get(): MultipartBody|array
    {
        $data = $this->data;

        if ($this->hasAttachments()) {
            $data['attachments'] = array_map(
                static fn (AttachmentBuilder $attachment) => $attachment->get(),
                $this->getAttachments()
            );
        }

        if ($this->hasComponents()) {
            $data['components'] = $this->getComponents()->get();
        }

        if ($this->hasEmbeds()) {
            $data['embeds'] = array_map(
                static fn (EmbedBuilder $embed) => $embed->get(),
                $this->getEmbeds()
            );
        }

        if ($this->hasAllowedMentions()) {
            $data['allowed_mentions'] = $this->getAllowedMentions()->get();
        }

        if ($this->requiresMultipart()) {
            return $this->getMultipart($data);
        }

        return $data;
    }
}
