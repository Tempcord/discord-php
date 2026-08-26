<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Mapping;

class CompletedMapping
{
    /**
     * @param mixed $result
     * @param MappingException[] $errors
     */
    public function __construct(public readonly mixed $result, public readonly array $errors)
    {
    }
}
