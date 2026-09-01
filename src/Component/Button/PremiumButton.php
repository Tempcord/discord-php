<?php

declare(strict_types=1);

namespace Tempcord\Discord\Component\Button;

use Tempcord\Discord\Component\Component;
use Tempcord\Discord\Enums\ButtonStyle;
use Tempcord\Discord\Rest\Helpers\Emoji\EmojiBuilder;

class PremiumButton extends Component
{
    private ButtonStyle $style = ButtonStyle::Premium;

    public function __construct(
        private string $skuId,
        private bool $disabled = false
    ) {
    }

    public function get(): array
    {
        $data =  [
            'type' => 2,
            'style' => $this->style,
            'sku_id' => $this->skuId,
            'disabled' => $this->disabled,
        ];

        return $data;
    }
}
