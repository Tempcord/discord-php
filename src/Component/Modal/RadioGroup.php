<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component\Modal;

use CyberWolf\Discord\Component\Component;
use CyberWolf\Discord\Enums\MessageComponentType;
use CyberWolf\Discord\Exceptions\Component\TooManyItemsException;

/**
 * A set of mutually exclusive choices. Discord requires at least two.
 *
 * @see https://discord.com/developers/docs/components/reference#radio-group
 */
class RadioGroup extends Component
{
    public const MIN_OPTIONS = 2;
    public const MAX_OPTIONS = 10;

    /** @var Option[] */
    private array $options = [];

    public function __construct(
        private readonly string $customId,
        private readonly ?bool $required = null,
        private readonly ?int $id = null
    ) {
    }

    /**
     * @throws TooManyItemsException
     */
    public function add(Option $option): self
    {
        if (count($this->options) === self::MAX_OPTIONS) {
            throw new TooManyItemsException(
                'A radio group can hold at most ' . self::MAX_OPTIONS . ' options'
            );
        }

        $this->options[] = $option;

        return $this;
    }

    public function get(): array
    {
        $data = [
            'type' => MessageComponentType::RADIO_GROUP->value,
            'custom_id' => $this->customId,
            'options' => array_map(static fn (Option $option) => $option->get(), $this->options),
        ];

        if (!is_null($this->required)) {
            $data['required'] = $this->required;
        }

        if (!is_null($this->id)) {
            $data['id'] = $this->id;
        }

        return $data;
    }
}
