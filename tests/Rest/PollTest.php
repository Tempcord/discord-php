<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest;

use CyberWolf\Discord\Parts\Message;
use CyberWolf\Discord\Parts\PollAnswerVoters;
use CyberWolf\Discord\Rest\Poll;
use Tests\CyberWolf\Discord\Rest\HttpHelperTestCase;

class PollTest extends HttpHelperTestCase
{
    protected string $httpItemClass = Poll::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'Get answer voters' => [
                'method' => 'getAnswerVoters',
                'args' => ['::channel id::', '::message id::', 1],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) ['users' => []],
                ],
                'validationOptions' => [
                    'returnType' => PollAnswerVoters::class,
                ],
            ],
            'Get answer voters with pagination' => [
                'method' => 'getAnswerVoters',
                'args' => ['::channel id::', '::message id::', 1, '::after::', 100],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) ['users' => []],
                ],
                'validationOptions' => [
                    'returnType' => PollAnswerVoters::class,
                ],
            ],
            'End poll' => [
                'method' => 'endPoll',
                'args' => ['::channel id::', '::message id::'],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => Message::class,
                ],
            ],
        ];
    }
}
