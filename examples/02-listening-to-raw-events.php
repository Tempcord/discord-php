<?php

use CyberWolf\Discord\Bitwise\Bitwise;
use CyberWolf\Discord\Constants\Events;
use CyberWolf\Discord\Constants\OpCodes;
use CyberWolf\Discord\Discord;
use CyberWolf\Discord\Gateway\Handlers\GatewayEvent;
use CyberWolf\Discord\Gateway\Objects\Payload;

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
