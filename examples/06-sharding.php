<?php

use CyberWolf\Discord\Bitwise\Bitwise;
use CyberWolf\Discord\Discord;
use CyberWolf\Discord\Gateway\Shard;

require './vendor/autoload.php';

$discord = new Discord(
    'TOKEN'
);

$discord
    ->withGateway(Bitwise::from(
        // ...
    ))
    ->withRest();

$discord->gateway->shard(new Shard(1, 16));

$discord->gateway->open(); // Nothing after this line is executed
