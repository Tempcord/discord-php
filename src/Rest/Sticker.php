<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest;

use Discord\Http\Endpoint;
use Tempcord\Discord\Parts\Sticker as PartsSticker;
use Tempcord\Discord\Parts\StickerPack;
use React\Promise\PromiseInterface;

/**
 * @see https://discord.com/developers/docs/resources/sticker
 */
class Sticker extends HttpResource
{
    /**
     * @see https://discord.com/developers/docs/resources/sticker#get-sticker
     *
     * @return PromiseInterface<\Tempcord\Discord\Parts\Sticker>
     */
    public function get(string $stickerId): PromiseInterface
    {
        return $this->mapPromise(
            $this->http->get(
                Endpoint::bind(
                    Endpoint::STICKER,
                    $stickerId
                )
            ),
            PartsSticker::class
        );
    }

    /**
     * @see https://discord.com/developers/docs/resources/sticker#list-nitro-sticker-packs
     *
     * @return PromiseInterface<\Tempcord\Discord\Parts\StickerPack[]>
     */
    public function listNitroPacks(): PromiseInterface
    {
        return $this->mapArrayPromise(
            $this->http->get(
                Endpoint::bind(
                    Endpoint::STICKER_PACKS,
                )
            ),
            StickerPack::class
        );
    }
}
