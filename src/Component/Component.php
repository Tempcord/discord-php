<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Component;

abstract class Component
{
    abstract public function get(): array;
}
