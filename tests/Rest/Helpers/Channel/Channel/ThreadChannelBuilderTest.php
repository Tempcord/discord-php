<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest\Helpers\Channel\Channel;

use PHPUnit\Framework\TestCase;
use Tempcord\Discord\Rest\Helpers\Channel\Channel\ThreadChannelBuilder;

class ThreadChannelBuilderTest extends TestCase
{
    public function testItAppliesForumTags(): void
    {
        $builder = ThreadChannelBuilder::new()->setAppliedTags(['::voting::', '::urgent::']);

        $this->assertSame(['applied_tags' => ['::voting::', '::urgent::']], $builder->get());
        $this->assertSame(['::voting::', '::urgent::'], $builder->getAppliedTags());
    }

    /**
     * Discord replaces the whole set, so the keys have to be a plain list — an
     * array with gaps in it serialises to an object and the call is refused.
     */
    public function testTagsAreSentAsAList(): void
    {
        $tags = [3 => '::voting::', 7 => '::urgent::'];

        $this->assertSame(
            '{"applied_tags":["::voting::","::urgent::"]}',
            json_encode(ThreadChannelBuilder::new()->setAppliedTags($tags)->get()),
        );
    }

    public function testTakingEveryTagOffIsSaidWithAnEmptyList(): void
    {
        $this->assertSame(['applied_tags' => []], ThreadChannelBuilder::new()->setAppliedTags([])->get());
    }

    public function testItArchivesAndLocks(): void
    {
        $builder = ThreadChannelBuilder::new()->setArchived(true)->setLocked(true);

        $this->assertSame(['archived' => true, 'locked' => true], $builder->get());
    }

    public function testItSetsTheIdleTimeBeforeArchiving(): void
    {
        $this->assertSame(
            ['auto_archive_duration' => 1440],
            ThreadChannelBuilder::new()->setAutoArchiveDuration(1440)->get(),
        );
    }

    public function testItSetsWhoMayAddOthers(): void
    {
        $this->assertSame(['invitable' => false], ThreadChannelBuilder::new()->setInvitable(false)->get());
    }

    public function testItSetsSlowmode(): void
    {
        $this->assertSame(
            ['rate_limit_per_user' => 30],
            ThreadChannelBuilder::new()->setRateLimitPerUser(30)->get(),
        );
    }

    public function testItRenames(): void
    {
        $this->assertSame(['name' => '::title::'], ThreadChannelBuilder::new()->setName('::title::')->get());
    }

    /**
     * A thread has no channel type of its own to send, unlike every other
     * builder here — Discord infers it from the channel being modified, and
     * sending one is refused.
     */
    public function testItSendsNoChannelType(): void
    {
        $this->assertArrayNotHasKey('type', ThreadChannelBuilder::new()->setName('::title::')->get());
    }
}
