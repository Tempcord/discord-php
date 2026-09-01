<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest;

use Discord\Http\Endpoint;
use Tempcord\Discord\Parts\Message;
use Tempcord\Discord\Parts\PollAnswerVoters;
use React\Promise\PromiseInterface;

/**
 * @see https://discord.com/developers/docs/resources/poll
 */
class Poll extends HttpResource
{
    /**
     * @see https://discord.com/developers/docs/resources/poll#get-answer-voters
     *
     * @return PromiseInterface<\Tempcord\Discord\Parts\PollAnswerVoters>
     */
    public function getAnswerVoters(
        string $channelId,
        string $messageId,
        int $answerId,
        ?string $after = null,
        ?int $limit = null
    ): PromiseInterface {
        $endpoint = Endpoint::bind(
            Endpoint::MESSAGE_POLL_ANSWER,
            $channelId,
            $messageId,
            $answerId
        );

        if (!is_null($after)) {
            $endpoint->addQuery('after', $after);
        }

        if (!is_null($limit)) {
            $endpoint->addQuery('limit', $limit);
        }

        return $this->mapPromise(
            $this->http->get($endpoint),
            PollAnswerVoters::class
        );
    }

    /**
     * Ends a poll early. Discord rejects this for polls the current user did
     * not create.
     *
     * @see https://discord.com/developers/docs/resources/poll#end-poll
     *
     * @return PromiseInterface<\Tempcord\Discord\Parts\Message>
     */
    public function endPoll(string $channelId, string $messageId): PromiseInterface
    {
        return $this->mapPromise(
            $this->http->post(
                Endpoint::bind(
                    Endpoint::MESSAGE_POLL_EXPIRE,
                    $channelId,
                    $messageId
                )
            ),
            Message::class
        );
    }
}
