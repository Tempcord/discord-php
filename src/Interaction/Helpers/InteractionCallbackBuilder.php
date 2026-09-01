<?php

declare(strict_types=1);

namespace Tempcord\Discord\Interaction\Helpers;

use Discord\Http\Multipart\MultipartBody;
use Tempcord\Discord\Enums\InteractionCallbackType;
use Tempcord\Discord\Rest\Helpers\Channel\EmbedBuilder;
use Tempcord\Discord\Rest\Helpers\Channel\Message\AddComponent;
use Tempcord\Discord\Rest\Helpers\Channel\Message\AddEmbed;
use Tempcord\Discord\Rest\Helpers\Channel\Message\AddFile;
use Tempcord\Discord\Rest\Helpers\Channel\Message\AllowMentions;
use Tempcord\Discord\Rest\Helpers\Channel\Message\MultipartMessage;
use Tempcord\Discord\Rest\Helpers\Channel\Message\SetContent;
use Tempcord\Discord\Rest\Helpers\Channel\Message\SetFlags;
use Tempcord\Discord\Rest\Helpers\Channel\Message\SetTts;
use Tempcord\Discord\Rest\Helpers\GetNew;

class InteractionCallbackBuilder
{
    use GetNew;

    use SetTts;
    use SetContent;
    use AddEmbed;
    use AllowMentions;
    use SetFlags;
    use AddComponent;
    use AddFile;
    use MultipartMessage;

    private InteractionCallbackType $type;

    private ModalBuilder $modal;

    private array $data = [];

    /**
     * Responds to the interaction by opening a modal, which sets the callback
     * type as well since a modal cannot be sent as any other kind of response.
     */
    public function setModal(ModalBuilder $modal): self
    {
        $this->modal = $modal;

        return $this->setType(InteractionCallbackType::MODAL);
    }

    public function getModal(): ?ModalBuilder
    {
        return $this->modal ?? null;
    }

    public function setType(InteractionCallbackType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): InteractionCallbackType
    {
        return $this->type;
    }

    public function get(): array|MultipartBody
    {
        $callbackData = $this->data;

        if (isset($this->modal)) {
            return [
                'type' => $this->type->value,
                'data' => $this->modal->get(),
            ];
        }

        if ($this->hasComponents()) {
            $callbackData['components'] = $this->getComponents()->get();
        }

        if ($this->hasEmbeds()) {
            $callbackData['embeds'] = array_map(
                static fn (EmbedBuilder $embed) => $embed->get(),
                $this->getEmbeds()
            );
        }

        if ($this->hasAllowedMentions()) {
            $callbackData['allowed_mentions'] = $this->getAllowedMentions()->get();
        }

        $data = [
            'type' => $this->type->value,
        ];

        if ($callbackData !== []) {
            $data['data'] = $callbackData;
        }

        if ($this->requiresMultipart()) {
            return $this->getMultipart($data);
        }

        return $data;
    }
}
