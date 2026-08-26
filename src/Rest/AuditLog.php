<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest;

use Discord\Http\Endpoint;
use CyberWolf\Discord\Parts\AuditLog as PartsAuditLog;
use CyberWolf\Discord\Rest\Helpers\AuditLog\GetGuildAuditLogsBuilder;
use React\Promise\PromiseInterface;

/**
 * @see https://discord.com/developers/docs/resources/audit-log
 */
class AuditLog extends HttpResource
{
    /**
     * @see https://discord.com/developers/docs/resources/audit-log#get-guild-audit-log
     *
     * @return PromiseInterface<\CyberWolf\Discord\Parts\AuditLog>
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
