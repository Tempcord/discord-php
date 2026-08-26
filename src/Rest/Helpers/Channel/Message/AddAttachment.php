<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest\Helpers\Channel\Message;

use CyberWolf\Discord\Rest\Helpers\Channel\AttachmentBuilder;

trait AddAttachment
{
    /** @var AttachmentBuilder[] */
    private array $attachments;

    /**
     * @see https://discord.com/developers/docs/resources/channel#attachment-object
     */
    public function addAttachment(AttachmentBuilder $attachment): self
    {
        if (!isset($this->attachments)) {
            $this->attachments = [];
        }

        $this->attachments[] = $attachment;

        return $this;
    }

    /** @return AttachmentBuilder[] */
    public function getAttachments(): ?array
    {
        return $this->attachments ?? null;
    }

    public function hasAttachments(): bool
    {
        return isset($this->attachments);
    }
}
