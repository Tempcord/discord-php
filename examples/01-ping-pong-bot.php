<?php

use CyberWolf\Discord\Bitwise\Bitwise;
use CyberWolf\Discord\Constants\Events;
use CyberWolf\Discord\Discord;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Gateway\Events\MessageCreate;
use CyberWolf\Discord\Rest\Helpers\Channel\MessageBuilder;

require './vendor/autoload.php';

$discord = new Discord(
    'TOKEN'
);

$discord
    ->withGateway(Bitwise::from(
        Intent::GUILD_MESSAGES,
        Intent::DIRECT_MESSAGES,
        Intent::MESSAGE_CONTENT,
    ))
    ->withRest();

$discord->gateway->events->on(Events::MESSAGE_CREATE, static function (MessageCreate $message) use ($discord) {
    if ($message->content === '!ping') {
        $discord->rest->channel->createMessage(
            $message->channel_id,
            (new MessageBuilder())
                ->setContent('pong!')
        );
    }
});

$discord->gateway->open(); // Nothing after this line is executed
