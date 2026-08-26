<?php

use CyberWolf\Discord\Bitwise\Bitwise;
use CyberWolf\Discord\Constants\Events;
use CyberWolf\Discord\Discord;
use CyberWolf\Discord\Enums\Intent;
use CyberWolf\Discord\Gateway\Events\MessageCreate;
use CyberWolf\Discord\Rest\Helpers\Channel\MessageBuilder;

require './vendor/autoload.php';

$discord = new Discord('TOKEN');

$discord
    ->withGateway(Bitwise::from(
        Intent::GUILD_MESSAGES,
        Intent::DIRECT_MESSAGES,
        Intent::MESSAGE_CONTENT,
    ))
    ->withRest();

$discord->gateway->events->on(Events::MESSAGE_CREATE, static function (MessageCreate $message) use ($discord) {
    if ($message->content === '!ping') {
        $sendMessages = static function (string $channelId, array $items) use ($discord, &$sendMessages) {
            if (count($items) === 0) {
                return;
            }

            $messageToSend = array_shift($items);

            $discord->rest->channel->createMessage(
                $channelId,
                (new MessageBuilder())->setContent($messageToSend)
            )->then(static fn () => $sendMessages($channelId, $items));
        };

        $sendMessages($message->channel_id, ['this', 'will', 'sent', 'in', 'order']);
    }
});

$discord->gateway->open(); // Nothing after this line is executed
