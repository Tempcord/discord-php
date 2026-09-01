<?php

declare(strict_types=1);

namespace Fakes\Tempcord\Discord;

use Tempcord\Discord\Discord;
use Mockery;
use Mockery\Mock;

class DiscordFake
{
    public static function get(): Mock|Discord
    {
        $discord = Mockery::mock(Discord::class);

        $discord->rest = RestFake::get();
        $discord->gateway = GatewayFake::get();

        return $discord;
    }
}
