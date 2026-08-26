<?php

declare(strict_types=1);

namespace Tests\CyberWolf\Discord\Rest;

use CyberWolf\Discord\Parts\AuditLog as PartsAuditLog;
use CyberWolf\Discord\Rest\AuditLog;
use CyberWolf\Discord\Rest\Helpers\AuditLog\GetGuildAuditLogsBuilder;
use Tests\CyberWolf\Discord\Rest\HttpHelperTestCase;

class AuditLogTest extends HttpHelperTestCase
{
    protected string $httpItemClass = AuditLog::class;

    public static function httpBindingsProvider(): array
    {
        return [
            'Get guild audit log' => [
                'method' => 'getGuildAuditLogs',
                'args' => ['::guild id::', new GetGuildAuditLogsBuilder()],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => PartsAuditLog::class
                ]
            ],
        ];
    }
}
