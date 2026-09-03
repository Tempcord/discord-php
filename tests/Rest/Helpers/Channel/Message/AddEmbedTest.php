<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest\Helpers\Channel\Message;

use PHPUnit\Framework\TestCase;
use Tempcord\Discord\Exceptions\Rest\Helpers\Message\TooManyEmbedsException;
use Tempcord\Discord\Rest\Helpers\Channel\EmbedBuilder;
use Tempcord\Discord\Rest\Helpers\Channel\MessageBuilder;

/**
 * Discord takes ten embeds in a message and refuses the whole message over the
 * eleventh — the reply that would have carried them never appears, and the only
 * sign is a Bad Request naming a field rather than a builder. A bot listing one
 * embed per item found this the season the list grew to thirteen.
 */
class AddEmbedTest extends TestCase
{
    public function testItTakesTheLimit(): void
    {
        $builder = MessageBuilder::new();

        for ($i = 0; $i < 10; $i++) {
            $builder->addEmbed(EmbedBuilder::new()->setTitle('#' . $i));
        }

        $this->assertCount(10, $builder->getEmbeds());
    }

    public function testItRefusesTheOneAfter(): void
    {
        $builder = MessageBuilder::new();

        for ($i = 0; $i < 10; $i++) {
            $builder->addEmbed(EmbedBuilder::new()->setTitle('#' . $i));
        }

        $this->expectException(TooManyEmbedsException::class);
        $this->expectExceptionMessage('takes 10 embeds in a message and was given 11');

        $builder->addEmbed(EmbedBuilder::new()->setTitle('one too many'));
    }
}
