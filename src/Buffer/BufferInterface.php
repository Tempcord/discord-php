<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Buffer;

use Closure;

interface BufferInterface
{
    public function partialMessage(string $partial): void;
    public function onCompleteMessage(Closure $handler): void;
    public function additionalQueryData(): array;
    public function reset(): void;
}
