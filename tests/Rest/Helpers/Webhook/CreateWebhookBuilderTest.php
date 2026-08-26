<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest\Helpers\Webhook;

use PHPUnit\Framework\TestCase;
use CyberWolf\Discord\Enums\ImageData;
use CyberWolf\Discord\Rest\Helpers\Webhook\CreateWebhookBuilder;

class CreateWebhookBuilderTest extends TestCase
{
    public function testItCanSetTheAvatar()
    {
        $builder = CreateWebhookBuilder::new();
        $builder->setAvatar('::image::', ImageData::PNG);

        $this->assertEquals('data:image/png;base64,OjppbWFnZTo6', $builder->getAvatar());
    }

    public function testItCanSetTheName()
    {
        $builder = CreateWebhookBuilder::new();
        $builder->setName('::name::');

        $this->assertEquals('::name::', $builder->getName());
    }
}
