<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Mapping;

use RuntimeException;
use Throwable;

class MappingException extends RuntimeException
{
    public function __construct(
        string $message,
        public readonly string $propertyName,
        public readonly string $className,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, previous: $previous);
    }
}
