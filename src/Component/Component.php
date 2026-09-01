<?php

declare(strict_types=1);

namespace Tempcord\Discord\Component;

abstract class Component
{
    abstract public function get(): array;
}
