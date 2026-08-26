<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest;

use CyberWolf\Discord\Enums\InteractionCallbackType;
use CyberWolf\Discord\Interaction\Helpers\InteractionCallbackBuilder;
use CyberWolf\Discord\Parts\Message;
use CyberWolf\Discord\Rest\Helpers\Webhook\EditWebhookBuilder;
use CyberWolf\Discord\Rest\Webhook;
use Tests\CyberWolf\Discord\Rest\HttpHelperTestCase;

class WebhookTest extends HttpHelperTestCase
{
    protected string $httpItemClass = Webhook::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'Create interaction response' => [
                'method' => 'createInteractionResponse',
                'args' => [
                    '::interaction id::',
                    '::interaction token::',
                    InteractionCallbackBuilder::new()
                        ->setType(InteractionCallbackType::APPLICATION_COMMAND_AUTOCOMPLETE_RESULT),
                ],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            'Get original interaction response' => [
                'method' => 'getOriginalInteractionResponse',
                'args' => [
                    '::application id::',
                    '::interaction token::',
                ],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => Message::class,
                ],
            ],
            'Edit original interaction response' => [
                'method' => 'editOriginalInteractionResponse',
                'args' => [
                    '::application id::',
                    '::interaction token::',
                    EditWebhookBuilder::new()
                ],
                'mockOptions' => [
                    'method' => 'patch',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => Message::class,
                ],
            ],
            'Delete original interaction response' => [
                'method' => 'deleteOriginalInteractionResponse',
                'args' => [
                    '::application id::',
                    '::interaction token::'
                ],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
        ];
    }
}
