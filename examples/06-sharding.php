<?php

use Tempcord\Discord\Bitwise\Bitwise;
use Tempcord\Discord\Discord;
use Tempcord\Discord\Gateway\Shard;

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
