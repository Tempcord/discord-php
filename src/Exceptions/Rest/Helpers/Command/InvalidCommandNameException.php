<?php

declare(strict_types=1);

namespace CyberWolf\Discord\Exceptions\Rest\Helpers\Command;

use Exception;
use CyberWolf\Discord\Constants\Validation\Command;

class InvalidCommandNameException extends Exception
{
    public function __construct(public readonly string $name)
    {
        parent::__construct(sprintf(
            'Command name "%s" does not match required pattern "%s"',
            $this->name,
            Command::NAME_REGEX
        ));
    }
}
