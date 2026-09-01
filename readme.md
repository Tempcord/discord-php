<p align="center">
    <img src="./assets/logo.svg" height="150px">
</p>

<h3 align="center">Discord PHP</h3>

<p align="center">PHP Discord Interface — API &amp; Gateway wrapper.</p>

<div align="center">

[![Code Quality](https://github.com/Tempcord/discord-php/actions/workflows/code-quality.yml/badge.svg)](https://github.com/Tempcord/discord-php/actions/workflows/code-quality.yml)
[![Unit Tests](https://github.com/Tempcord/discord-php/actions/workflows/unit-tests.yml/badge.svg)](https://github.com/Tempcord/discord-php/actions/workflows/unit-tests.yml)

</div>

## About

Discord PHP is a mostly plain wrapper over Discord's APIs/gateway.
There is no caching built in; this is for the user to implement themselves.

It heavily relies on ReactPHP for async operations. Knowing the basics of async
PHP is recommended before diving in.

> Discord PHP is a rebranded, maintained fork of
> [Fenrir](https://github.com/dc-Ragnarok/Fenrir) by Ragnarök. See
> [Credits](#credits) below.

## Install

```
composer require cyberwolf-studio/discord-php
```

## Example bot

```php
use Tempcord\Discord\Bitwise\Bitwise;
use Tempcord\Discord\Constants\Events;
use Tempcord\Discord\Discord;
use Tempcord\Discord\Enums\Intent;
use Tempcord\Discord\Gateway\Events\MessageCreate;
use Tempcord\Discord\Rest\Helpers\Channel\MessageBuilder;

require './vendor/autoload.php';

$discord = new Discord('TOKEN');

$discord
    ->withGateway(Bitwise::from(
        Intent::GUILD_MESSAGES,
        Intent::DIRECT_MESSAGES,
        Intent::MESSAGE_CONTENT,
    ))
    ->withRest();

$discord->gateway->events->on(Events::MESSAGE_CREATE, function (MessageCreate $message) use ($discord) {
    if ($message->content === '!ping') {
        $discord->rest->channel->createMessage(
            $message->channel_id,
            (new MessageBuilder())
                ->setContent('pong!')
        );
    }
});

$discord->gateway->open(); // Nothing after this line is executed
```

## REST-only example

```php
use Tempcord\Discord\Discord;
use Tempcord\Discord\Rest\Helpers\Channel\MessageBuilder;

require './vendor/autoload.php';

$discord = new Discord('TOKEN');
$discord->withRest();

$discord->rest->channel->createMessage(
    'channel-id',
    (new MessageBuilder())
        ->setContent('Hi there!')
);
```
(Note: going with REST-only means you do NOT receive any events and your bot will appear offline)

For more examples, check out the examples directory.

## Support

Discord PHP currently supports PHP 8.5+.
Tests should pass on nightly builds of newer versions, but this is not a supported usecase.

Note: Bugfixes/features will not be backported to older versions. Older versions are as-is.

If you're using this in an Apache2/Nginx/etc webserver environment, you should probably
limit yourself to only using the REST capabilities. These environments typically don't
allow long-running processes.

32-bit is not supported, though no hard limit is in place.

## Contributing

Contributions are welcome.
You can look for `@todo` to find something that requires attention.
Please make sure to write tests where possible & make sure your code matches the phpcs configuration.
Thanks!

## Credits

Discord PHP is a fork of **[Fenrir](https://github.com/dc-Ragnarok/Fenrir)**,
originally created by **Ragnarök** and released under the MIT License. All original
copyright is retained in [LICENSE](LICENSE). Huge thanks to the original authors and
contributors for the foundation this project is built on.

## Notice

The current underlying HTTP component is subject to change in the future.
While the accessible API for it will remain similar, you should try to refrain from
using it manually in your application.

## License

Released under the MIT License. See [LICENSE](LICENSE) for the full text, including
the original Fenrir copyright.
