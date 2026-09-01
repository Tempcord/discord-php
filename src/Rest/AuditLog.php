<?php

declare(strict_types=1);

namespace Tempcord\Discord\Rest;

use Discord\Http\Endpoint;
use Tempcord\Discord\Parts\AuditLog as PartsAuditLog;
use Tempcord\Discord\Rest\Helpers\AuditLog\GetGuildAuditLogsBuilder;
use React\Promise\PromiseInterface;

/**
 * @see https://discord.com/developers/docs/resources/audit-log
 */
class AuditLog extends HttpResource
{
    /**
     * @see https://discord.com/developers/docs/resources/audit-log#get-guild-audit-log
     *
     * @return PromiseInterface<\Tempcord\Discord\Parts\AuditLog>
     */
    public function getGuildAuditLogs(
        string $guildId,
        GetGuildAuditLogsBuilder $getGuildAuditLogsBuilder
    ): PromiseInterface {
        return $this->mapPromise(
            $this->http->get(
                Endpoint::bind(
                    Endpoint::AUDIT_LOG,
                    $guildId
                ),
                $getGuildAuditLogsBuilder->get()
            ),
            PartsAuditLog::class
        );
    }
}
