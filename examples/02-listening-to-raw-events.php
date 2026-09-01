<?php

use Tempcord\Discord\Bitwise\Bitwise;
use Tempcord\Discord\Constants\Events;
use Tempcord\Discord\Constants\OpCodes;
use Tempcord\Discord\Discord;
use Tempcord\Discord\Gateway\Handlers\GatewayEvent;
use Tempcord\Discord\Gateway\Objects\Payload;

require './vendor/autoload.php';

class RawHandler extends GatewayEvent {
    public static function getEventName(): string
    {
        return OpCodes::EVENTS; // Or any other OP code
    }

    public function execute(): void
    {
        // ...
        // $this->payload
        // $this->connectionInterface
        // $this->logger
    }
}

$discord = new Discord('TOKEN');

$discord
    ->withGateway(new Bitwise())// Enable your desired Gateway intents
    ->withRest();

$discord->gateway->raw->register(RawHandler::class);

$discord->gateway->open(); // Nothing after this line is executed
