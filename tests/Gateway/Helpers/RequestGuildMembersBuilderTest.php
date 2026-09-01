<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Gateway\Helpers;

use Tempcord\Discord\Exceptions\Gateway\Helpers\RequestGuildMembers\InvalidRequestException;
use Tempcord\Discord\Gateway\Helpers\RequestGuildMembersBuilder;
use PHPUnit\Framework\TestCase;

class RequestGuildMembersBuilderTest extends TestCase
{
    public function testAsksForEveryoneInAGuild(): void
    {
        $this->assertEquals(
            ['guild_id' => '::guild id::', 'query' => '', 'limit' => 0],
            RequestGuildMembersBuilder::everyone('::guild id::')->get()
        );
    }

    public function testSearchesByName(): void
    {
        $request = RequestGuildMembersBuilder::new()
            ->setGuildId('::guild id::')
            ->setQuery('vla')
            ->setLimit(10);

        $this->assertEquals(
            ['guild_id' => '::guild id::', 'query' => 'vla', 'limit' => 10],
            $request->get()
        );
    }

    /**
     * Discord takes either a query or a list of ids, never both, so the ids win
     * and the query is left out rather than sent alongside them.
     */
    public function testUserIdsReplaceTheQuery(): void
    {
        $request = RequestGuildMembersBuilder::new()
            ->setGuildId('::guild id::')
            ->setQuery('ignored')
            ->setUserIds(['1', '2']);

        $this->assertEquals(
            ['guild_id' => '::guild id::', 'user_ids' => ['1', '2']],
            $request->get()
        );
    }

    public function testCarriesPresencesAndNonceWhenAsked(): void
    {
        $request = RequestGuildMembersBuilder::everyone('::guild id::')
            ->setPresences(true)
            ->setNonce('::nonce::');

        $this->assertEquals(
            [
                'guild_id' => '::guild id::',
                'query' => '',
                'limit' => 0,
                'presences' => true,
                'nonce' => '::nonce::',
            ],
            $request->get()
        );
    }

    public function testRefusesARequestWithoutAGuild(): void
    {
        $this->expectException(InvalidRequestException::class);

        RequestGuildMembersBuilder::new()->setQuery('')->get();
    }

    /**
     * Discord answers a request carrying neither by never answering at all, so
     * it is caught here instead of waiting on a chunk that will not come.
     */
    public function testRefusesARequestThatAsksForNothing(): void
    {
        $this->expectException(InvalidRequestException::class);

        RequestGuildMembersBuilder::new()->setGuildId('::guild id::')->get();
    }

    public function testExposesWhatItWasGiven(): void
    {
        $request = RequestGuildMembersBuilder::everyone('::guild id::')
            ->setPresences(false)
            ->setNonce('::nonce::');

        $this->assertEquals('::guild id::', $request->getGuildId());
        $this->assertEquals('', $request->getQuery());
        $this->assertEquals(0, $request->getLimit());
        $this->assertFalse($request->getPresences());
        $this->assertEquals('::nonce::', $request->getNonce());
        $this->assertNull($request->getUserIds());
    }
}
