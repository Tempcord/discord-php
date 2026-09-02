<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest\Helpers\Emoji;

use Tempcord\Discord\Parts\Emoji;
use Tempcord\Discord\Rest\Helpers\GetNew;

class EmojiBuilder
{
    use GetNew;

    private array $data = [];

    public function setName(string $name): self
    {
        $this->data['name'] = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->data['name'] ?? null;
    }

    public function setAnimated(bool $animated): self
    {
        $this->data['animated'] = $animated;

        return $this;
    }

    public function getAnimated(): ?bool
    {
        return $this->data['animated'] ?? null;
    }

    public function setId(string $id): self
    {
        $this->data['id'] = $id;

        return $this;
    }

    public function getId(): ?string
    {
        return $this->data['id'] ?? null;
    }

    public static function fromPart(Emoji $emoji): self
    {
        $builder = new self();

        if (isset($emoji->animated)) {
            $builder->setAnimated($emoji->animated);
        }

        if (isset($emoji->name)) {
            $builder->setName($emoji->name);
        }

        if (isset($emoji->id)) {
            $builder->setId($emoji->id);
        }

        return $builder;
    }

    public function get(): array
    {
        return $this->data;
    }

    /**
     * The emoji as a reaction endpoint takes it.
     *
     * A custom emoji is "name:id". A standard one is the character itself,
     * percent encoded, and may be held under either key: fromPart() puts it in
     * name, because that is where Discord sends it in a reaction event, while
     * setId() has long been the documented way to write one by hand.
     *
     * @see https://discord.com/developers/docs/resources/channel#create-reaction
     */
    public function __toString(): string
    {
        $id = $this->data['id'] ?? null;
        $name = $this->data['name'] ?? null;

        if ($id !== null && $name !== null) {
            return $name . ':' . $id;
        }

        return rawurlencode((string) ($name ?? $id));
    }
}
