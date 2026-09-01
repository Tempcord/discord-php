<?php

declare(strict_types=1);

namespace Tests\Tempcord\Discord\Rest;

use Tempcord\Discord\Parts\AuditLog as PartsAuditLog;
use Tempcord\Discord\Rest\AuditLog;
use Tempcord\Discord\Rest\Helpers\AuditLog\GetGuildAuditLogsBuilder;
use Tests\Tempcord\Discord\Rest\HttpHelperTestCase;

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
