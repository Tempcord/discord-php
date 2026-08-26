<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Rest;

use Discord\Http\Http;
use Psr\Log\LoggerInterface;
use CyberWolf\Discord\DataMapper;
use React\Promise\PromiseInterface;

abstract class HttpResource
{
    public function __construct(
        protected Http $http,
        protected DataMapper $dataMapper,
        protected LoggerInterface $logger
    ) {
    }

    protected function mapPromise(PromiseInterface $promise, string $class): PromiseInterface
    {
        return $promise->then(function ($data) use ($class) {
            return $this->dataMapper->map($data, $class);
        });
    }

    protected function mapArrayPromise(PromiseInterface $promise, string $class): PromiseInterface
    {
        return $promise->then(function ($data) use ($class) {
            return $this->dataMapper->mapArray($data, $class);
        });
    }

    protected function getAuditLogReasonHeader(?string $reason = null): array
    {
        return is_null($reason) ? [] : ['X-Audit-Log-Reason' => rawurlencode($reason)];
    }
}
